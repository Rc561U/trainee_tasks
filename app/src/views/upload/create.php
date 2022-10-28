<div class="container ">
    <div class="box">
        <h3 class="display-4 text-center">Upload</h3><br>
        <div id="status">

        </div>
        <div class="row">
            <div class="col">
                <form  method="post" id="upload_form" enctype="multipart/form-data">
                    <label  class="form-label mb-0">Upload file</label>
                    <div>
                        <input class="form-control" type="file" name="fileToUpload" id="fileToUpload" " required >
                    </div>
                    <input class="btn btn-primary mt-4" type="submit" value="Upload" name="submit">
<!--/                    <button type="submit" class="btn btn-primary mt-4">Submit</button>-->
                </form>
            </div>
        </div>
    </div>
</div>
<script src="/resources/js/upload_validation.js" defer></script>
