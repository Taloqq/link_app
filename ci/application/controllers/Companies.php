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
    public function page($data = NULL) {

        $path = FCPATH.'/json/paikkakunnat.json';
        $data['cities'] = json_decode(file_get_contents($path), true);
        $data['placesFI'] = array('Alajärvi', 'Alavieska', 'Alavus', 'Asikkala', 'Askola', 'Aura', 'Akaa', 'Brändö', 'Eckerö', 'Enonkoski', 'Enontekiö', 'Espoo', 'Eura', 'Eurajoki', 'Evijärvi', 'Finström', 'Forssa', 'Föglö', 'Geta', 'Haapajärvi', 'Haapavesi', 'Hailuoto', 'Halsua', 'Hamina', 'Hammarland', 'Hankasalmi', 'Hanko', 'Harjavalta', 'Hartola', 'Hattula', 'Hausjärvi', 'Heinävesi', 'Helsinki', 'Vantaa', 'Hirvensalmi', 'Hollola', 'Honkajoki', 'Huittinen', 'Humppila', 'Hyrynsalmi', 'Hyvinkää', 'Hämeenkyrö', 'Hämeenlinna', 'Heinola', 'Ii', 'Iisalmi', 'Iitti', 'Ikaalinen', 'Ilmajoki', 'Ilomantsi', 'Inari', 'Inkoo', 'Isojoki', 'Isokyrö', 'Imatra', 'Janakkala', 'Joensuu', 'Jokioinen', 'Jomala', 'Joroinen', 'Joutsa', 'Juuka', 'Juupajoki', 'Juva', 'Jyväskylä', 'Jämijärvi', 'Jämsä', 'Järvenpää', 'Kaarina', 'Kaavi', 'Kajaani', 'Kalajoki', 'Kangasala', 'Kangasniemi', 'Kankaanpää', 'Kannonkoski', 'Kannus', 'Karijoki', 'Karkkila', 'Karstula', 'Karvia', 'Kaskinen', 'Kauhajoki', 'Kauhava', 'Kauniainen', 'Kaustinen', 'Keitele', 'Kemi', 'Keminmaa', 'Kempele', 'Kerava', 'Keuruu', 'Kihniö', 'Kinnula', 'Kirkkonummi', 'Kitee', 'Kittilä', 'Kiuruvesi', 'Kivijärvi', 'Kokemäki', 'Kokkola', 'Kolari', 'Konnevesi', 'Kontiolahti', 'Korsnäs', 'Koski Tl', 'Kotka', 'Kouvola', 'Kristiinankaupunki', 'Kruunupyy', 'Kuhmo', 'Kuhmoinen', 'Kumlinge', 'Kuopio', 'Kuortane', 'Kurikka', 'Kustavi', 'Kuusamo', 'Outokumpu', 'Kyyjärvi', 'Kärkölä', 'Kärsämäki', 'Kökar', 'Kemijärvi', 'Kemiönsaari', 'Lahti', 'Laihia', 'Laitila', 'Lapinlahti', 'Lappajärvi', 'Lappeenranta', 'Lapinjärvi', 'Lapua', 'Laukaa', 'Lemi', 'Lemland', 'Lempäälä', 'Leppävirta', 'Lestijärvi', 'Lieksa', 'Lieto', 'Liminka', 'Liperi', 'Loimaa', 'Loppi', 'Loviisa', 'Luhanka', 'Lumijoki', 'Lumparland', 'Luoto', 'Luumäki', 'Lohja', 'Parainen', 'Maalahti', 'Maarianhamina', 'Marttila', 'Masku', 'Merijärvi', 'Merikarvia', 'Miehikkälä', 'Mikkeli', 'Muhos', 'Multia', 'Muonio', 'Mustasaari', 'Muurame', 'Mynämäki', 'Myrskylä', 'Mäntsälä', 'Mäntyharju', 'Mänttä-Vilppula', 'Naantali', 'Nakkila', 'Nivala', 'Nokia', 'Nousiainen', 'Nurmes', 'Nurmijärvi', 'Närpiö', 'Orimattila', 'Oripää', 'Orivesi', 'Oulainen', 'Oulu', 'Padasjoki', 'Paimio', 'Paltamo', 'Parikkala', 'Parkano', 'Pelkosenniemi', 'Perho', 'Pertunmaa', 'Petäjävesi', 'Pieksämäki', 'Pielavesi', 'Pietarsaari', 'Pedersören kunta', 'Pihtipudas', 'Pirkkala', 'Polvijärvi', 'Pomarkku', 'Pori', 'Pornainen', 'Posio', 'Pudasjärvi', 'Pukkila', 'Punkalaidun', 'Puolanka', 'Puumala', 'Pyhtää', 'Pyhäjoki', 'Pyhäjärvi', 'Pyhäntä', 'Pyhäranta', 'Pälkäne', 'Pöytyä', 'Porvoo', 'Raahe', 'Raisio', 'Rantasalmi', 'Ranua', 'Rauma', 'Rautalampi', 'Rautavaara', 'Rautjärvi', 'Reisjärvi', 'Riihimäki', 'Ristijärvi', 'Rovaniemi', 'Ruokolahti', 'Ruovesi', 'Rusko', 'Rääkkylä', 'Raasepori', 'Saarijärvi', 'Salla', 'Salo', 'Saltvik', 'Sauvo', 'Savitaipale', 'Savonlinna', 'Savukoski', 'Seinäjoki', 'Sievi', 'Siikainen', 'Siikajoki', 'Siilinjärvi', 'Simo', 'Sipoo', 'Siuntio', 'Sodankylä', 'Soini', 'Somero', 'Sonkajärvi', 'Sotkamo', 'Sottunga', 'Sulkava', 'Sund', 'Suomussalmi', 'Suonenjoki', 'Sysmä', 'Säkylä', 'Vaala', 'Sastamala', 'Siikalatva', 'Taipalsaari', 'Taivalkoski', 'Taivassalo', 'Tammela', 'Tampere', 'Tervo', 'Tervola', 'Teuva', 'Tohmajärvi', 'Toholampi', 'Toivakka', 'Tornio', 'Turku', 'Pello', 'Tuusniemi', 'Tuusula', 'Tyrnävä', 'Ulvila', 'Urjala', 'Utajärvi', 'Utsjoki', 'Uurainen', 'Uusikaarlepyy', 'Uusikaupunki', 'Vaasa', 'Valkeakoski', 'Valtimo', 'Varkaus', 'Vehmaa', 'Vesanto', 'Vesilahti', 'Veteli', 'Vieremä', 'Vihti', 'Viitasaari', 'Vimpeli', 'Virolahti', 'Virrat', 'Vårdö', 'Vöyri', 'Ylitornio', 'Ylivieska', 'Ylöjärvi', 'Ypäjä', 'Ähtäri', 'Äänekoski');
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
            
        $json_url = 'https://avoindata.prh.fi/bis/v1?totalResults=false&maxResults=20'. $info['city'] . $info['industry'];

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