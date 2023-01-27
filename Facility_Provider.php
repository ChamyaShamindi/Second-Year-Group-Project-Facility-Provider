<?php
Session::init();
class Facility_Provider extends Controller{
    private $ListingModel;
    public function __construct(){
        Middleware::authorizeUser(Session::get('userrole'), 'facility_provider');
        $this->ListingModel = $this->loadModel('Facility_Providers');
    }

    public function index(){

    }

    public function myListing(){
        $this->loadView('facility_provider/myListing');
    }
    
    public function addItem(){

        if (isset($_POST['submit'])) {

            //Start the session
            Session::init();

            //Check and validate the data
            //Set errors if something is wrong
            $topic = $_POST['topic'];
            $description = $_POST['description'];
            $rental = $_POST['rental'];
            $location = $_POST['location'];
            $address = $_POST['address'];
            $uniName = $_POST['uniName'];
            $images = $_FILES['images'];
            $special_note = $_POST['special_note'];
            $category = $_POST['category'];

            $uniList = [];
            foreach ($uniName as $uni){
                array_push($uniList, trim($uni));
            }

            // $data = [
            //     'images' => $_FILES['images']
            // ];

            // $this->loadView('test',$data);
            
            

            $data = [
                'topic' => trim($topic),
                'description' => trim($description),
                'rental' => trim($rental),
                'location' => trim($location),
                'address' => trim($address),
                'uniName' => json_encode($uniList),
                'images' => $_FILES['images'],
                'special_note' => trim($special_note),
                'category' => trim($category),
                'topic_err' => '',
                'description_err' => '',
                'rental_err' => '',
                'location_err' => '',
                'address_err' => '',
                'uniName_err' => '',
                'images_err' => '',
                'special_note_err' => '',
                'category_err' => ''
            ];

            //Check whether all the fields are filled properly
            if(!$_POST['topic'] && !$_POST['description'] && !$_POST['rental'] && !$_POST['location'] && !$_POST['address'] && !$_POST['uniName'] && !$_POST['images'] && !$_POST['special_note'] && !$_POST['category']){
                $data['topic_err'] =  "*This field is Required";
                $data['description_err'] = "*This field is Required";
                $data['rental_err'] = "*This field is Required";
                $data['location_err'] = "*This field is Required";
                $data['address_err'] = "*This field is Required";
                $data['uniName_err'] = "*This field is Required";
                $data['images_err'] = "*This field is Required";
                $data['special_note_err'] = "*This field is Required";
                $data['category_err'] = "*You should choose a category";
            }

            $num_of_images = count($images['name']);    //number of images

            $uploaded_images = [];

            for($i=0; $i< $num_of_images; $i++){
                //get the image information and store them in var
                $image_name = $images['name'][$i];
                $tmp_name = $images['tmp_name'][$i];
                $error = $images['error'][$i];
                $uploaded_images[] = [
                    "name" => $image_name,
                    "tmp_name" => $tmp_name,
                    "error" => $error
                ];
            }


            $image_urls = [];

            foreach($uploaded_images as $uploaded_image) {
                //get image extension store it in var
                $image_ex = pathinfo($uploaded_image["name"], PATHINFO_EXTENSION);  

                //convert the image extension into lower case and store it in var
                $image_ex_lc = strtolower($image_ex);

                //create array that stores allowed to upload image extensions
                $allowed_exs = array('jpg', 'jpeg', 'png');

                //check if the image extension is present in $allowed_exs array
                if(in_array($image_ex_lc, $allowed_exs)){  

                    //renaming the image name with random string             
                    $new_image_name = uniqid('IMG-', true).'.'.$image_ex_lc;   

                    //creating upload path on root directory
                    $image_upload_path = APPROOT. "/uploads/listingImg/". $new_image_name;

                    //move uploaded image to 'images' folder
                    move_uploaded_file($uploaded_image["tmp_name"], $image_upload_path);

                    $images = json_encode($images);
                    $image_urls[] = $image_upload_path;
                    // header("Location: propertyView.php");
                }else{
                    echo("You can't upload files of this category");
                }
            }

            $image_urls = json_encode($image_urls);
     
            $uniName = json_encode($uniName);
            
            $validatedData = [
                'topic' => $data['topic'],
                'description' => $data['description'],
                'rental' => $data['rental'],
                'location' => $data['location'],
                'address' => $data['address'],
                'uniName' => $uniName,
                'image_urls' => $image_urls,
                'special_note' => $data['special_note'],
                'category' => $data['category']
            ];

            //Make sure there are no error flags are set
            if(empty($data['topic_err']) && empty($data['description_err']) && empty($data['rental_err']) && empty($data['location_err']) && empty($data['address_err']) 
                && empty($data['uniName_err']) && empty($data['images_err']) && empty($data['special_note_err']) && empty($data['category_err']) ){

                if($this->ListingModel->addItem($validatedData)){
                    Middleware::redirect('./facility_provider');
                }
            }else{
                //load the same page with erros
                $this->loadView('facility_provider/addItem', $data);
            }
               
        }else{
            //Send the empty detail page
            $data = [ 
                'topic' => '',
                'description' => '',
                'rental' => '',
                'location' => '',
                'address' => '',
                'uniName' => '',
                'images' => '',
                'special_note' => '',
                'category' => '',
                'topic_err' => '',
                'description_err' => '',
                'rental_err' => '',
                'location_err' => '',
                'address_err' => '',
                'uniName_err' => '',
                'images_err' => '',
                'special_note_err' => '',
                'category_err' => ''
            ];

            $this->loadView('facility_provider/addItem', $data);
        }
    }

    public function propertyView(){
        $this->loadView('facility_provider/propertyView');
    }

}

?>