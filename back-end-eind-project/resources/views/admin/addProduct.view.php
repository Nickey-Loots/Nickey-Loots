<?php addProduct($conn); ?>
<?php isLoggedIn('?page=login') ?>


<section class="add-product">
   <form action="" method="POST" enctype="multipart/form-data">
      <h3>product details</h3>
      <p>product name <span>*</span></p>
      <input type="text" name="name" required maxlength="50" placeholder="enter product name" class="box">
      <p>product price <span>*</span></p>
      <input type="number" name="price" required maxlength="10" min="0" max="9999999999" placeholder="enter product price" class="box">
      <p>product image <span>*</span></p>
      <input type="file" name="image" required accept="image/*" class="box">
      <input type="submit" value="add product" name="addProduct" class="btn">
   </form>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

</body>
</html>
