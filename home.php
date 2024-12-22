<?php

include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
   $user_id = $_COOKIE['user_id'];
} else {
   $user_id = '';
}

$select_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ?");
$select_likes->execute([$user_id]);
$total_likes = $select_likes->rowCount();

$select_comments = $conn->prepare("SELECT * FROM `comments` WHERE user_id = ?");
$select_comments->execute([$user_id]);
$total_comments = $select_comments->rowCount();

$select_bookmark = $conn->prepare("SELECT * FROM `bookmark` WHERE user_id = ?");
$select_bookmark->execute([$user_id]);
$total_bookmarked = $select_bookmark->rowCount();

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'components/user_header.php'; ?>


   <section class="home_cover">

      <div class="container heder-containar">
         <?php if ($user_id == '') { ?>
            <div class="hdr-left">
               <h1>The Best Courses you will find heare!</h1>
               <p>
                  Lorem ipsum dolor sit amet consectetur adipisicing elit.
                  Ut exercitationem veniam, voluptatum consectetur possimus tempore
                  sed molestias magni dicta eum et inventore eveniet dolorum aut,
                  nemo doloribus earum corrupti distinctio.
               </p>
               <a href="selectuser.php" class="btn btnsignup">Login</a>
            </div>
            <div class="hdr-rigth">
               <div class="hdr-img">
                  <img src="images/teacher.png" alt="teacher and student">
               </div>
            </div>
         <?php } ?>
      </div>

   </section>



   <section class="courses">

      <h1 class="heading">latest courses</h1>

      <div class="box-container">

         <?php
         $select_courses = $conn->prepare("SELECT * FROM `playlist` WHERE status = ? ORDER BY date DESC LIMIT 6");
         $select_courses->execute(['active']);
         if ($select_courses->rowCount() > 0) {
            while ($fetch_course = $select_courses->fetch(PDO::FETCH_ASSOC)) {
               $course_id = $fetch_course['id'];

               $select_tutor = $conn->prepare("SELECT * FROM `tutors` WHERE id = ?");
               $select_tutor->execute([$fetch_course['tutor_id']]);
               $fetch_tutor = $select_tutor->fetch(PDO::FETCH_ASSOC);
         ?>
               <div class="box">
                  <div class="tutor">
                     <img src="uploaded_files/<?= $fetch_tutor['image']; ?>" alt="">
                     <div>
                        <h3><?= $fetch_tutor['name']; ?></h3>
                        <span><?= $fetch_course['date']; ?></span>
                     </div>
                  </div>
                  <img src="uploaded_files/<?= $fetch_course['thumb']; ?>" class="thumb" alt="">
                  <h3 class="title"><?= $fetch_course['title']; ?></h3>
                  <a href="playlist.php?get_id=<?= $course_id; ?>" class="inline-btn">view playlist</a>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">no courses added yet!</p>';
         }
         ?>

      </div>

      <div class="more-btn">
         <a href="courses.php" class="inline-option-btn">view more</a>
      </div>

   </section>
   <section class="about">

      <div class="row">

         <div class="image">
            <img src="images/aboutus.png" alt="">
         </div>

         <div class="content">
            <h3>who are we?</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque nobis distinctio, nisi consequatur ad sequi, rem odit fugiat assumenda eligendi iure aut sunt ratione, tempore porro expedita quisquam.</p>
            <a href="courses.html" class="inline-btn">our courses</a>
         </div>

      </div>

      <div class="box-container">

         <div class="box">
            <i class="fas fa-graduation-cap"></i>
            <div>
               <h3>+1k</h3>
               <span>online courses</span>
            </div>
         </div>

         <div class="box">
            <i class="fas fa-user-graduate"></i>
            <div>
               <h3>+25k</h3>
               <span>brilliants students</span>
            </div>
         </div>

         <div class="box">
            <i class="fas fa-chalkboard-user"></i>
            <div>
               <h3>+5k</h3>
               <span>expert teachers</span>
            </div>
         </div>

         <div class="box">
            <i class="fas fa-briefcase"></i>
            <div>
               <h3>100%</h3>
               <span>job placement</span>
            </div>
         </div>

      </div>

   </section>

   <br>
   <br>
   <br>
   <br>
   <br>
   <br>
   <section class="contact">

      <div class="row">

         <div class="image">
            <img src="images/us.svg" alt="">
         </div>

         <form action="" method="post">
            <h3>get in touch</h3>
            <input type="text" placeholder="enter your name" required maxlength="100" name="name" class="box">
            <input type="email" placeholder="enter your email" required maxlength="100" name="email" class="box">
            <input type="number" min="0" max="9999999999" placeholder="enter your number" required maxlength="10" name="number" class="box">
            <textarea name="msg" class="box" placeholder="enter your message" required cols="30" rows="10" maxlength="1000"></textarea>
            <input type="submit" value="send message" class="inline-btn" name="submit">
         </form>

      </div>

      <div class="box-container">

         <div class="box">
            <i class="fas fa-phone"></i>
            <h3>phone number</h3>
            <a href="tel:0598079239">059-807-9239</a>
            <a href="tel:0568807710">056-880-7710</a>
         </div>

         <div class="box">
            <i class="fas fa-envelope"></i>
            <h3>email address</h3>
            <a href="mailto:admakrm3@gmail.com">admakrm3@gmail.com</a>
            <a href="mailto:Amjad.kayed@hotmail.com">Amjad.kayed@hotmail.com</a>
         </div>




      </div>

   </section>












   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>