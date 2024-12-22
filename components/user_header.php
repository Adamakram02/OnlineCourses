<?php
if (isset($message)) {
   foreach ($message as $message) {
      echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <section class="flex">

      <a href="home.php" class="logo">PSCHOOL</a>

      <nav class="navbar">
         <a href="home.php"><i class="fas fa-home"></i><span>home</span></a>
         <a href="about.php"><i class="fa-solid fa-circle-question"></i><span>about us</span></a>
         <a href="courses.php"><i class="fas fa-graduation-cap"></i><span>courses</span></a>
         <a href="teachers.php"><i class="fas fa-chalkboard-user"></i><span>teachers</span></a>
         <a href="contact.php"><i class="fa-solid fa-phone"></i><span>contact us</span></a>
      </nav>


      <div class="icons">
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
         $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
         $select_profile->execute([$user_id]);
         if ($select_profile->rowCount() > 0) {
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
            <img src="uploaded_files/<?= $fetch_profile['image']; ?>" alt="">
            <h3><?= $fetch_profile['name']; ?></h3>
            <span>student</span>
            <a href="profile.php" class="btn"><i class="fa-solid fa-user"></i> view profile</a>
            <a href="update.php" class="btn"><i class="fa-solid fa-pen-to-square"></i> update profile</a>
            <a href="components/user_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn"><i class="fa-solid fa-right-from-bracket"></i> logout</a>
         <?php
         } else {
         ?>
            <h3>please login or register</h3>
            <div class="flex-btn">
               <a href="selectuser.php" class="option-btn">login</a>
               <a href="selectreg.php" class="option-btn">register</a>
            </div>
         <?php
         }
         ?>
      </div>

   </section>

</header>