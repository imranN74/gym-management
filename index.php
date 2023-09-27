  <style>
body {
    background-image: url('images/gym6.jpg');
    background-size: cover;
    overflow: auto;
}
  </style>
  <?php 
include('header.php');
include "connection.php";
$id=$_SESSION['id'];
$sql=mysqli_query($con,"SELECT COUNT(*)cnt from users where id='$id' and is_accepted='1'");
$fetch=mysqli_fetch_array($sql);
 $cnt=$fetch['cnt'];

//  $plan=mysqli_query($con,"SELECT * from 'fee_plan'");

?>
  <div class="container">
      <div class="row" style="">
          <?php if($cnt<1){ ?>
          <div style="border:2px solid; color:red;background:rgba(250,251,248,1);border-radius:10px;"
              class="col-sm-6">
              <h1>इसका पालन करना जरूरी है</h1>

              <p>1.जिम में किसी भी तरह का न नसा ना करें</p>
              <p>2. जिम में किसी भी तरह का नशील पदार्थ को लाना मना है।</p>
              <p>3. बिना Admission आना मना है।</p>
              <p>4. अपना पानी व  तौलिया साथ मे लाए।</p>
              <p>5. किसी भी तरह का नुकसान करने वाले से हरजाना लिया जायेगा।</p>
              <p>6. यदी कोई मेम्बर किसी दूसरे व्यक्ति को अंदर लाता है तो लाने वाले व्यक्ति <br>का एडमीशन रद कर दिया जायेगा।</p>
              <p>7. जिम के अंदर सोर न मचाये</p>
              <p>8.जो समान जहा से लाये है उसे  वहि रख दे</p>
              <p>9. खुला बदन जिम नहीं करे लोवर और गंजी पहन के करें।</p>
              <p>10.आपकी PLAN समाप्त होने के 2 से 3 दिनों के भीतर PAY करें</p>
              <p>11.आप का मंथली पूरा होने पर एक दो दिन के अंदर जमा कर देना होगा नहीं तो<br> प्रवेश वर्जित कर दिया जायेगा l</p>
              <p>12.जिम एक दिन जाये या दस दिन Fee पुरा लगेगा।</p>
              <p>13.अगर आप को किसी भी तरह के नुकसान होता है तो जिम्मेदारी आपकि होगी।</p>
              <div class="form-group" id="form"><br>
                  <form action="action.php" method="post">
                      <input type="checkbox" name="check" required><span
                          style="font-size:20px; color:black;">&nbsp;Accept Terms and Conditions</span>
                      &nbsp;<button type="submit" name="proceed" class="btn btn-info">Proceed</button>
                  </form>
              </div>
          </div>
          <?php }else{?>
          <div class="col-sm-6"
              style="border:2px solid; color:red;background:rgba(250,251,248,1);border-radius:10px;">
              <table class="table">
                <center><h1 style="text-decoration:underline">Plan Details</h1></center>
                  <thead>
                      <tr>
                          <th scope="col">SL.No</th>
                          <th scope="col">Days</th>
                          <th scope="col">Fee</th>
                          <th scope="col">Adm Fee</th>
                          <th scope="col">Total</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                          <th scope="row">1</th>
                          <td>30</td>
                          <td>Rs.500</td>
                          <td>Rs.200</td>
                          <td>Rs.700</td>
                      </tr>
                      <tr>
                          <th scope="row">2</th>
                          <td>60</td>
                          <td>Rs.900</td>
                          <td>Rs.200</td>
                          <td>Rs.1100</td>
                      </tr>
                      <tr>
                          <th scope="row">4</th>
                          <td>90</td>
                          <td>Rs.1200</td>
                          <td>-</td>
                          <td>Rs.1200</td>
                      </tr>
                      <tr>
                          <th scope="row">5</th>
                          <td>180</td>
                          <td>Rs.2200</td>
                          <td>-</td>
                          <td>Rs.2200</td>
                      </tr>
                      <tr>
                          <th scope="row">6</th>
                          <td>365</td>
                          <td>Rs.4000</td>
                          <td>-</td>
                          <td>Rs.4000</td>
                      </tr>
                  </tbody>
              </table>
          </div>
          <?php } ?>
      </div>
  </div>
  </body>

  </html>
  <script>
$(document).ready(function() {
    $('#myTable').DataTable();
});
  </script>