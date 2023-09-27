<?php include "header.php"; ?>
<br />
<form class="form" action="action.php" method="post">
<center><h1>Fitness Point</h1></center>
    <div class='container'>
        <div style='border:1px solid #000; padding:10px; border-radius:4px;'>
            <div class='row'>
                <div class='col-sm-6'>
                    <div class="form-group">
                        <label for="">Name <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" placeholder="Name" autocomplete="off" id="name"
                            aria-describedby="name" name="name" required>
                    </div>
                </div>
                <div class='col-sm-6'>
                <label for="">Mobile <span style="color:red;">*</span></label>
                    <div class="form-group">
                        <input type="number" class="form-control" name="mobile" placeholder="Mobile" id="mobile"
                            autocomplete="off" required>
                    </div>
                </div>
            </div>
            <br />
            <div class='row'>
                <div class='col-sm-6'>
                <label for="">Address <span style="color:red;">*</span></label>
                    <div class="form-group">
                        <input type="Text" class="form-control" placeholder="Address" id="address" autocomplete="off"
                            name="addr" required>
                    </div>
                </div>
                <div class='col-sm-6'>
                    <div class="form-group">
                    <label for="">Weight(Kg)</label>
                        <input type="number" autocomplete="off" class="form-control" placeholder="Weight (Kg)"
                            id="weight" name="weight">
                    </div>
                </div>
            </div>

            <br />
            <div class='row'>
                <div class='col-sm-6'>
                    <div class="form-group">
                    <label for="">Height(Cm)</label>
                        <input type="number" autocomplete="off" class="form-control" placeholder="height (Cm)"
                            id="height" name="height">
                    </div>
                </div>
                <div class='col-sm-6'>
                    <div class="form-group">
                    <label for="">Admission date <span style="color:red;">*</span></label>
                        <input type="date" autocomplete="off" class="form-control" id="adm_date" name="adm_date" required>
                    </div>
                </div>
            </div>
          <br />
            <div class='row'>
                <div class='col-sm-4'>
                    <div class="form-group">
                    </div>
                </div>
                <div class='col-sm-4'>
                    <div class="form-group">
                        <center>
                          <button type='submit' name='signup' class='btn btn-info btn-sm'>REGISTER</button>
                        </center>
                    </div>
                </div>
                <div class='col-sm-4'>
                    <div class="form-group">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

</body>

</html>