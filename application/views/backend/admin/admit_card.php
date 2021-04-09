

<?php
    $id = $param2;
    $student = $this->db->get_where('pre_student',array('pre_student_id'=>$id))->row();
    $class_id = $this->db->get_where('pre_enroll',array('student_id'=>$id))->row();

?>
<script>
$.fn.extend({
	print: function() {
		var frameName = 'printIframe';
		var doc = window.frames[frameName];
		if (!doc) {
			$('<iframe>').hide().attr('name', frameName).appendTo(document.body);
			doc = window.frames[frameName];
		}
		doc.document.body.innerHTML = this.html();
		doc.window.print();
		return this;
	}
});
</script>

<div class=" " id="admit_card">
    <style>

    .id-card-holder {
        width: 225px;
        padding: 4px;
        margin: 0 auto;
        background-color: #1f1f1f;
        border-radius: 5px;
        position: relative;
    }
    .id-card-holder:after {
        content: '';
        width: 7px;
        display: block;
        background-color: #0a0a0a;
        height: 100px;
        position: absolute;
        top: 105px;
        border-radius: 0 5px 5px 0;
    }
    .id-card-holder:before {
        content: '';
        width: 7px;
        display: block;
        background-color: #0a0a0a;
        height: 100px;
        position: absolute;
        top: 105px;
        left: 222px;
        border-radius: 5px 0 0 5px;
    }
    .id-card {

        background-color: #fff;
        padding: 10px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 0 1.5px 0px #b9b9b9;
    }
    .id-card img {
        margin: 0 auto;
    }
    .header img {
        width: 100px;
        margin-top: 15px;
    }
    .photo img {
        width: 80px;
        margin-top: 15px;
    }
    .id-card  h2 {
        font-size: 15px;
        margin: 5px 0;
    }
    .id-card h3 {
        font-size: 12px;
        margin: 2.5px 0;
        font-weight: 300;
    }
    .qr-code img {
        width: 50px;
    }
    .id-card  p {
        font-size: 5px;
        margin: 2px;
    }
    .id-card-hook {
        background-color: #000;
        width: 70px;
        margin: 0 auto;
        height: 15px;
        border-radius: 5px 5px 0 0;
    }
    .id-card-hook:after {
        content: '';
        background-color: #d7d6d3;
        width: 47px;
        height: 6px;
        display: block;
        margin: 0px auto;
        position: relative;
        top: 6px;
        border-radius: 4px;
    }
    .id-card-tag-strip {
        width: 45px;
        height: 40px;
        background-color: #0950ef;
        margin: 0 auto;
        border-radius: 5px;
        position: relative;
        top: 9px;
        z-index: 1;
        border: 1px solid #0041ad;
    }
    .id-card-tag-strip:after {
        content: '';
        display: block;
        width: 100%;
        height: 1px;
        background-color: #c1c1c1;
        position: relative;
        top: 10px;
    }
    .id-card-tag {
        width: 0;
        height: 0;
        border-left: 100px solid transparent;
        border-right: 100px solid transparent;
        border-top: 100px solid #0958db;
        margin: -10px auto -30px auto;
    }
    .id-card-tag:after {
        content: '';
        display: block;
        width: 0;
        height: 0;
        border-left: 50px solid transparent;
        border-right: 50px solid transparent;
        border-top: 100px solid #d7d6d3;
        margin: -10px auto -30px auto;
        position: relative;
        top: -130px;
        left: -50px;
    }

    .admit_label {

    width: 40%;
    background: #eee;
    padding: 10px;
    border-bottom: 1px solid #ddd;
    font-weight: 600;
    color: #000;
    letter-spacing: 0.5px;

}

.admit_value{
    width: 60%;
}

#admit_card tr td {

    padding: 10px !important;
    border: 1px solid #ddd;

}

#admit_card {

    border: 1px solid #ddd;

}

</style>
  
    <div class="row" style="">
        <div class="p15">
            <h4 class="text-center" style="background: #fff;padding: 10px;font-weight: 600;margin: 0;border-bottom: 1px solid #ddd;">Pre Admission Test 2018</h4>
    </div>
        <div class="col-md-9 p0">
            <table class="col-md-12">
                <tr>
                    <td class="admit_label">Name</td>
                    <td class="admit_value"><?=$student->name;?></td>
                </tr>
                <tr>
                    <td class="admit_label">Registration Number</td>
                    <td class="admit_value"><?=$class_id->enroll_code;?></td>
                </tr>
                <tr>
                    <td class="admit_label">Date of Birth</td>
                    <td class="admit_value"><?=$student->birthday;?></td>
                </tr>

                <tr>
                    <td class="admit_label">
                        Catergory
                    </td>
                    <td class="admit_value">General</td>
                </tr>
            </table>
        </div>
        <div class="col-md-3 right_block">
            <div class="photo">
                <label for="">Photograph</label>
                <img src="<?php echo $this->crud_model->get_image_url('pre_student' , $student->pre_student_id);?>" alt="..." width="30">
            </div>
        </div> 
    </div>

     <div class="row " style="">
        <div class="p15">
            <h4 class="text-center" style="background: #eee;padding: 10px;font-weight: 600;margin: 0;border: 1px solid #ddd;">Exam Details</h4>
        </div>
        

       
        <div class="col-md-9 p0">
            <table class="col-md-12">
                <tr>
                    <td class="admit_label">Date and Day of Test</td>
                    <td class="admit_value">Friday, 19 October, 2018</td>
                </tr>
                <tr>
                    <td class="admit_label">Test Time/Session</td>
                    <td class="admit_value">10:00 AM - 01:00 PM</td>
                </tr>
                <tr>
                    <td class="admit_label">Test City</td>
                    <td class="admit_value">New Delhi</td>
                </tr>

                <tr>
                    <td class="admit_label">
                        Test Center
                    </td>
                    <td class="admit_value">C9/15, Sector-7, Rohini-110085</td>
                </tr>
            </table>
        </div>
        <div class="col-md-3 right_block p0">
            <div class="photo text-center">
                <label for="" >Canditate Signature</label>
            
        </div>
        </div> 


</div>
</div>
<!--<input type="button" onclick="printDiv('printableArea')" value="print a div!" />
<a  target="_blank" href="<?php echo site_url('admin/print_id/'.$student->pre_student_id);?>" class="btn btn-primary"><i class="entypo-print"></i> Print</a>-->


<button class="btn btn-primary" onclick="$('#admit_card').print();"><i class="entypo-print"></i>
Print
</button>
