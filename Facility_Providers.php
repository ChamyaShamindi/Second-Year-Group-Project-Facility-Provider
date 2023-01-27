<?php

    class Facility_Providers{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function addItem($data){
            //$listing_id = substr(sha1(date(DATE_ATOM)), 0, 8);
            $this->db->query('INSERT INTO listing(topic, description, rental, location, address, uniName, image, special_note, category) VALUES (:topic, :description, :rental, :location, :address, :uniName, :image_urls, :special_note, :category)');
            
            $this->db->bind(':topic', $data['topic']);
            $this->db->bind(':description', $data['description']);
            $this->db->bind(':rental', $data['rental']);
            $this->db->bind(':location', $data['location']);
            $this->db->bind(':address', $data['address']);
            $this->db->bind(':uniName', $data['uniName']);
            $this->db->bind(':image_urls', $data['image_urls']);
            $this->db->bind(':special_note', $data['special_note']);
            $this->db->bind(':category', $data['category']);

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        public function propertyView(){
            $this->db->query('SELECT * FROM listing'); 
            
            $row = $this->db->getRes();
            return $row;
        }

        public function mylisting($reg_id,$data){
            $this->db->query('SELECT * FROM listing');  
        }

        public function searchItem($uniName,$topic,$rental){
            if(isset($_POST['search'])){
                $string = $_POST['searchbtn'];
                $this->db->query('SELECT * FROM listing WHERE uniName LIKE '%$string%' OR topic LIKE '%$string%' OR rental LIKE '%$string%' ');
                $this->db->bind(':uniName', $uniName);
                $this->db->bind(':topic', $topic);
                $this->db->bind(':rental', $rental);

                $row = $this->db->getRes();
                if($this->db->rowCount() > 0){
                    return true;
                }
                else
                    return false;
            }
        }

        public function findItemByLocation($location){
            $location = $_GET["location"] ?? "all";

            if(isset($_POST['locationFilter'])){
                $this->db->query('SELECT * FROM listing WHERE location');
                $this->db->bind(':location', $location);

                $row = $this->db->getRes();
                if($this->db->rowCount() > 0){
                    return true;
                }
                else
                    return false;
            }
        }

        public function findItemByType($type){
            $type = $_GET["type"] ?? "all";

            if(isset($_POST['typeFilter'])){
                $this->db->query('SELECT * FROM listing WHERE ');
                $this->db->bind(':type', $type);

                $row = $this->db->getRes();
                if($this->db->rowCount() > 0){
                    return true;
                }
                else
                    return false;
            }
        }

        public function findItemByRent($rental){
            $rental = $_GET["rental"] ?? "all";

            if(isset($_POST['rentalFilter'])){
                $this->db->query('SELECT * FROM listing WHERE rental');
                $this->db->bind(':rental', $rental);

                $row = $this->db->getRes();
                if($this->db->rowCount() > 0){
                    return true;
                }
                else
                    return false;
            }
        }

        public function findItemByUniversity($uniName){
            $uniName = $_GET["uniName"] ?? "all"; 

            if(isset($_POST['universityFilter'])){
                $this->db->query('SELECT * FROM listing WHERE uniName');
                $this->db->bind(':uniName', $uniName);

                $row = $this->db->getRes();
                if($this->db->rowCount() > 0){
                    return true;
                }
                else
                    return false;
            }
        }

        public function viewOneListing($listing_id,$data){
            $list_id = $_GET['id'];
            $this->db->query("SELECT * FROM listing WHERE listing_id='$list_id' ");
        }
    }


?>