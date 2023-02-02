<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/174ad75841.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/facility_provider/item.css"?>>
    <script src=<?php echo URLROOT . "/public/js/facility_provider/addItem.js"?> defer ></script>
    <title>Add Listings</title>

</head>
</head>
<body>
    <div class="page">
        <div class="sidebar">
            <div class="logo_content">
                <div class="logo">
                    <div class="logo_name"></div>
                </div>
                <i class="fa-solid fa-bars" id="btn"></i>
            </div>
            <ul class="nav_list">
                <li>
                    <a href="myListing">
                        <i class="fa-solid fa-gauge"></i>
                        <span class="links_name">My Listings</span>
                    </a>
                    <span class="tooltip">My Listings</span>
                </li>
                <li>
                    <a href="propertyView">
                        <i class="fa-solid fa-house-chimney"></i>
                        <span class="links_name">Property</span>
                    </a>
                    <span class="tooltip">Property</span>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-utensils"></i>
                        <span class="links_name">Food</span>
                    </a>
                    <span class="tooltip">Food</span>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-chair"></i>
                        <span class="links_name">Furniture</span>
                    </a>
                    <span class="tooltip">Furniture</span>
                </li>
            </ul>
            <div class="profile_content">
                <div class="profile">
                    <div class="profile_details">
                        <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=388&q=80" alt="">
                        <div class="name">
                            Nimali
                        </div>
                    </div>
                    <i class="fa-solid fa-arrow-right-from-bracket" id="log_out"></i>
                </div>
            </div>
        </div>

        <!-- <script>
            let btn = document.querySelector("#btn");
            let sidebar = document.querySelector(".sidebar");

            btn.onclick = function(){
                sidebar.classList.toggle("active");
            }
        </script>   -->     
    
        <div class="formContainer">
            <form action="" method="POST" enctype="multipart/form-data">
                <h1>Tell Us More About Your Listing</h1>

                <p>Property Name:</p>
                <input class="topic" name="topic" type="text">

                <p>Description:</p>
                <input class="description" name="description" type="text">

                <div class="sub1">
                    <div class="sub11">
                        <p>Price(Rs.):</p>
                        <input class="price" name="rental" type="text">
                    </div>

                    <div class="sub12">
                        <p>Nearest Town:</p>
                        <input class="town" name="location" type="text">
                    </div>
                </div>

                <div class="sub2">
                    <div class="sub21">
                        <p>Address:</p>
                        <input class="address" name="address" type="text">
                    </div>

                    <div class="sub22">
                        <p>Universities/Institutions Nearby:</p>
                        <input class="uniName" name="uniName[]" id="uniName_0" type="text">
                        <div id="another"></div>
                        <button type="button" class="addAnother" onclick="addAnother()">+ Add Another</button>
                    </div>
                </div>

                <?php
                    if (isset($_GET['error'])){
                        echo "<p class='error'>";
                        echo htmlspecialchars($_GET['error']);
                        echo "</p>";
                    }
                ?>
                
                <p>Images:</p>
                <label for="img"><i class="fa fa-plus"></i><br>Insert only four images</label>
                <input type="file" class="image" name="images[]" id="img" multiple>
                
                <p>Special Notes:</p>
                <input class="note" name="special_note" type="text">
                
                <div class="sub1">
                    <div class="sub11">
                        <p>Category:</p>
                        <div class="dropdown-menu">
                            <div class="select-btn">
                                <span class="Sbtn-text">Property</span>
                                <i class="fa-sharp fa-solid fa-chevron-down"></i>
                            </div>
                            <input type="text" name="category" class="category-dropdown" hidden>
                            <ul class="options">
                                <li class="option">Property</li> 
                                <li class="option">Food</li> 
                                <li class="option">Furniture</li>
                            </ul>
                        </div>
                    </div>
                    <!-- <div class="sub12">
                        <p>Type:</p>
                    </div> -->
                </div>
        
                <button type="submit" class="submitbtn" name="submit">Add Listing</button>
                
            </form>  
        </div>

    </div>
    
</body>
</html>