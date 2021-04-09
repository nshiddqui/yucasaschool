<div class="content-wrapper">

    <div class="col-12 text-right p0">
        
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6><strong>Add New School</strong></h6>
                    <hr>
                <form  action="" enctype="multipart/form-data" method="post">
                  
                        <div class="form-group">
                            <label for="version">APK Version</label>
                            <input type="text" class="form-control" id="version" name="version" placeholder="APK Version" required>
                        </div>
                        <div class="form-group">
                            <label class="radio-inline"><input type="radio" value="1" name="force" checked>Force Download</label>
                            <label class="radio-inline"><input type="radio" value="0" name="force">Don't Force Download</label>
                        </div>
                        <div class="form-group">
                            <label for="file">APK Upload</label>
                            <input type="file" class="form-control" id="file" name="file" placeholder="APK Upload" required>
                        </div>
                    <!--    <div class="form-group">-->
                    <!--        <label for="apk">Upload Apk</label>-->
                    <!--    <input type="file" name="file" id="apk"class="file-upload-default">-->
                    <!--</div>-->

                    <div class="save__options mt-4">
                        <hr>
                        <input type="submit" class="btn btn-success" name="submit" value="Upload">
                    </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
