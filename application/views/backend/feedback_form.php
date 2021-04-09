<div class="overlay-feedback"></div>
<div id="feedbackForm">
  <div class="close-feedback">
    <i class="fas fa-times"></i>		
  </div>
  
  <form>
    <h3 class="text-center">Send Query</h3>
    <div class="row feedback-details">
      <div class="col-sm-4">School Name - <br> <?= isset($system_name)? $system_name : 'Yucasa System' ?></div>
      <div class="col-sm-4">Email Id - <br>Yucasaian@gmail.com</div>
      <div class="col-sm-4">Contact Number -<br> 011 - 56565656</div>
    </div>

    <div class="form-group">
      <label for="exampleInputEmail1">Enter Subject</label>
      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Subject">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Message</label>
      <textarea name=""  class="form-control" id="" cols="30" rows="10"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Send Mail</button>
  </form>
  
</div>
<!-- EVENT POPUP  -->
