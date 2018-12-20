<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

 /* Class of Categories controller
 * 
 * @authors: Antte Alatalo, Sanna Eerola
 */

class Companies extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION['lang'])) {
            $this->set_lang('english');
        }
        $this->config->load('userlanguage');
        $this->load->helper(array('form', 'url', 'url_helper'));
        $this->load->library(array('form_validation', 'session'));
        //$this->load->helper('path');
        
    }
    
    public function index() {
        
        $lang_config = $this->config->item('userlanguage');
        $search = $lang_config[$_SESSION['lang']]['search'];

        $path = FCPATH.'/json/paikkakunnat.json';
        $data['cities'] = json_decode(file_get_contents($path), true);
        $data['title'] = $search;
        $this->load->view("templates/header");
        $this->load->view("haku", $data);
        $this->load->view("templates/footer");
        
    }
    
    /**
     * Hakutulosten selaamisen nopeuttamiseksi voi hakea seuraavien sivujen datan jo valmiiksi?
     */
    public function search() {
        
        $lang_config = $this->config->item('userlanguage');
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
            $this->session->set_userdata('filters', array(
                'city' => '&registeredOffice='.$this->input->post('city'),
                'industry' => '&businessLine='.$this->input->post('industry')
            ));
            
        header('Location: '. site_url("companies/page/1"));
        
        }     
        
    }
    
    public function page($id = NULL) {
        
        $lang_config = $this->config->item('userlanguage');
        $results_from = $id * 10 - 10;
        $json_url = 'https://avoindata.prh.fi/bis/v1?totalResults=false&maxResults=10&resultsFrom='.$results_from. $_SESSION['filters']['city'] . $_SESSION['filters']['industry'];
        
        //Checks if any results are found, return if not.
        if (!$data['json'] = $this->get_file_contents($json_url)) {
        
            $data['title'] = 'No results found';
            $this->load->view("templates/header");
            $this->load->view("haku", $data);
            $this->load->view("templates/footer");  
            return;
        }
        
        $data['results'] = $data['json']['results'];
        $data['companies'] = array();
        $data['next_page'] = $id + 1;
        $data['previous_page'] = $id - 1;
        $data['labels'] = $lang_config[$_SESSION['lang']];
        
        foreach ($data['results'] as $item):
            $data['companies'][] = json_decode(file_get_contents($item['detailsUri']), true);
        endforeach;
        
        $this->load->view("templates/header");
        $this->load->view("list", $data);
        $this->load->view("templates/footer");        
        
    }
    
    //Decodes json content from given url
    private function get_file_contents($url) {
        
        if (!$contents = json_decode(@file_get_contents($url), true)) {
            return false;
        }
        return $contents;
    }
    
    public function set_lang($lang = 'english') {
        
        unset($_SESSION['langcode']);
        unset($_SESSION['lang']);
        $_SESSION['lang'] = $lang;
        if ($lang = 'english') {
            $_SESSION['langcode'] = 'EN';
        }
        if ($lang = 'suomi') {
            $_SESSION['langcode'] = 'FI';
        }
        if ($lang = 'svenska') {
            $_SESSION['langcode'] = 'SE';
        }
        redirect($_SERVER['HTTP_REFERER']);
        //header('Location: '. base_url());
       
    }
    
}