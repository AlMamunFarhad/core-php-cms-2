<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>
  
    


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                        <?php 
                
                             

                                $per_page = 3;


                                if(isset($_GET['page'])){

                                $page = $_GET['page'];   

                                }else{

                                $page = "";  

                                }

                                if($page == "" || $page == 1){

                                $page_1 = 0;  


                                }else{

                                $page_1 =  ($page * $per_page) - $per_page;  

                                }


                                $query = "SELECT * FROM posts WHERE post_status = 'published' ";
                                $pagination_query = mysqli_query($connection,$query);
                                $post_count = mysqli_num_rows($pagination_query);        
                                $count = ceil($post_count / $per_page); 





                                $query = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_id DESC LIMIT $page_1, $per_page ";
                                $select_all_posts = mysqli_query($connection,$query);

                                if(mysqli_num_rows($select_all_posts) < 1){

                                    echo "<h1 class='text-center'>NO POSTS AVAILABLE SORRY</h1>";

                                }else{



                                while($row = mysqli_fetch_assoc($select_all_posts)){

                                $post_id      = $row['post_id'];
                                $post_title   = $row['post_title'];
                                $post_author  = $row['post_user'];
                                $post_date    = $row['post_date'];
                                $post_image   = $row['post_image'];
                                $post_content = substr($row['post_content'], 0,200);
                                $post_status  = $row['post_status'];



                                ?>

                                <h1 class="page-header">
                                Page Heading
                                <small>Secondary Text</small>
                                </h1>

                                <!-- First Blog Post -->
                                <h2>
                                <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title;  ?></a>
                                </h2>
                                <p class="lead">
                                by <a href="author_posts.php?author=<?php echo $post_author; ?>&post_id=<?php echo $post_id; ?>"><?php echo $post_author;  ?></a>
                                </p>
                                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date;  ?></p>
                                <hr>
                                <a href="post.php?p_id=<?php echo $post_id;  ?>">
                                <img class="img-responsive" src="images/<?php echo $post_image;  ?>" alt="">
                                </a>
                                <hr>
                                <p><?php echo $post_content;  ?></p>
                                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id;  ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                                <hr>

                                <?php 	} }  ?>

                                </div>

                                <!-- Blog Sidebar Widgets Column -->
                                <?php include "includes/sidebar.php"; ?>



                                </div>
                                <!-- /.row -->

                                <hr>

                                <?php 


                                ?>



                            <ul class="pager">

                            <?php 

                            for($i = 1;$i <= $count; $i++){

                            if($i == $page){

                            echo "<li><a class='active_link' style='color: white;' href='index.php?page={$i}'>$i</a></li>";   

                            }else{

                            echo "<li><a href='index.php?page={$i}'>$i</a></li>";     

                            }

                            }


                            ?>  






                            </ul>








                            <?php include "includes/footer.php"; ?>