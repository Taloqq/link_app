<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

 /* Class of Categories controller
 * 
 * @authors: Antte Alatalo, Sanna Eerola
 */

class Companies extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'url_helper'));
        $this->load->library('form_validation', 'session');
        //$this->load->helper('path');
    
    }
    
    /**
     * TODO: Haku funktioon ehdotuksia käyttäjän kirjoituksen perusteella
     * = käyttäjä kirjoittaa 'o' -> käyttäjälle esitetään dropdown lista o:lla alkavista paikkakunnista
     * KATSO: ci/json/paikkakunnat.json
     * miten lista toimialoista?
     */
     
    
    public function index() {
        $path = FCPATH.'/json/paikkakunnat.json';
        $data['cities'] = json_decode(file_get_contents($path), true);
        $data['title'] = 'Search companies';
        
        $this->load->view("templates/header");
        $this->load->view("haku", $data);
        $this->load->view("templates/footer");
        
    }
    
    /**
     * Hakutulosten selaamisen nopeuttamiseksi voi hakea seuraavien sivujen datan jo valmiiksi?
     */
    public function page($id = NULL) {

        $path = FCPATH.'/json/paikkakunnat.json';
        $data['cities'] = json_decode(file_get_contents($path), true);
        $this->form_validation->set_rules('city', 'City', 'required');
        $data['title'] = 'Search companies';
        
        if ($this->form_validation->run() === FALSE) {
            $this->load->view("templates/header");
            $this->load->view("haku", $data);
            $this->load->view("templates/footer");
        }
        
        else {
            $info = array(
                'city' => '&registeredOffice='.$this->input->post('city'),
                'industry' => '&businessLine='.$this->input->post('industry')
            );
            
        $json_url = 'https://avoindata.prh.fi/bis/v1?totalResults=false&maxResults=10'. $info['city'] . $info['industry'];

        //Tarkistaa onko hakutuloksia -> return jos ei
        if (!$data['json'] = json_decode(@file_get_contents($json_url), true)) {
            
            $data['title'] = 'No results found';
            $this->load->view("templates/header");
            $this->load->view("haku", $data);
            $this->load->view("templates/footer");  
            return;
            
        }
        $data['nextPage'] = $data['json']['nextResultsUri'];
        $data['results'] = $data['json']['results'];
        $data['companies'] = array();
        
        
        
        foreach ($data['results'] as $item):
            $data['companies'][] = json_decode(file_get_contents($item['detailsUri']), true);
        endforeach;
        
        $this->load->view("templates/header");
        $this->load->view("list", $data);
        $this->load->view("templates/footer");   
        
        }        
    }
    
}