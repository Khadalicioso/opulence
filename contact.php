<?php  

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

if(isset($_POST['send'])){

   $msg_id = create_unique_id();
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $message = $_POST['message'];
   $message = filter_var($message, FILTER_SANITIZE_STRING);

   $verify_contact = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $verify_contact->execute([$name, $email, $number, $message]);

   if($verify_contact->rowCount() > 0){
      $warning_msg[] = 'message sent already!';
   }else{
      $send_message = $conn->prepare("INSERT INTO `messages`(id, name, email, number, message) VALUES(?,?,?,?,?)");
      $send_message->execute([$msg_id, $name, $email, $number, $message]);
      $success_msg[] = 'message send successfully!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contact Us</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<!-- contact section starts  -->

<section class="contact">

   <div class="row">
      <div class="image">
         <img src="images/contact-img.svg" alt="">
      </div>
      <form action="" method="post">
         <h3>Get In Touch</h3>
         <input type="text" name="name" required maxlength="50" placeholder="Full Name" class="box">
         <input type="email" name="email" required maxlength="50" placeholder="Email Address" class="box">
         <input type="number" name="number" required maxlength="10" max="9999999999" min="0" placeholder="Phone Number" class="box">
         <textarea name="message" placeholder="Message" required maxlength="1000" cols="30" rows="10" class="box"></textarea>
         <input type="submit" value="Send" name="send" class="btn">
      </form>
   </div>

</section>

<!-- contact section ends -->

<!-- faq section starts  -->

<section class="faq" id="faq">

   <h1 class="heading">FAQ</h1>

   <div class="box-container">

      <div class="box">
         <h3><span>How do you ensure the privacy and security of my personal information?</span><i class="fas fa-angle-down"></i></h3>
         <p>Our commitment to your privacy is paramount. We employ industry-leading security measures to safeguard your personal data. Our advanced encryption protocols and secure data storage systems protect your information from unauthorized access. Additionally, we adhere to strict privacy regulations to ensure your peace of mind.</p>
      </div>

      <div class="box">
         <h3><span>What sets your luxury properties apart from others on the market?</span><i class="fas fa-angle-down"></i></h3>
         <p>Our curated selection of luxury properties stands out due to their unique architectural designs, prime locations, and exceptional amenities. We meticulously select properties that offer unparalleled exclusivity, privacy, and a luxurious lifestyle. Our team of experts has a keen eye for detail and ensures that each property meets the highest standards of quality and sophistication.</p>
      </div>

      <div class="box">
         <h3><span>How can I schedule a private viewing of a property?</span><i class="fas fa-angle-down"></i></h3>
         <p>To schedule a private viewing, simply contact our dedicated concierge team. They will assist you in arranging a convenient time and provide you with detailed information about the property. Our concierge service is available 24/7 to cater to your specific needs and preferences.</p>
      </div>

      <div class="box">
         <h3><span>What financing options are available for purchasing a luxury property?</span><i class="fas fa-angle-down"></i></h3>
         <p>We understand the unique financial needs of our discerning clientele. Our team of experienced financial advisors can assist you in exploring various financing options, including mortgage loans, private financing, and other tailored solutions. We will work closely with you to find the most suitable financing arrangement to meet your specific requirements.</p>
      </div>

      <div class="box">
         <h3><span>How do you ensure the authenticity and legal clarity of the properties you list?</span><i class="fas fa-angle-down"></i></h3>
         <p>We prioritize transparency and integrity in all our dealings. Each property listed on our platform undergoes rigorous due diligence to verify ownership, legal documentation, and property history. Our team of experts works closely with reputable legal professionals to ensure that all transactions are conducted ethically and legally.</p>
      </div>

      <div class="box">
         <h3><span>What post-purchase services do you offer to your clients?</span><i class="fas fa-angle-down"></i></h3>
         <p>Our commitment to exceptional service extends beyond the purchase process. We offer a range of post-purchase services, including property management, interior design consultation, and concierge services. Our dedicated team is available to assist you with any needs or requests, ensuring a seamless and luxurious experience.</p>
      </div>
   </div>
</section>

<!-- faq section ends -->










<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php include 'components/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<?php include 'components/message.php'; ?>

</body>
</html>