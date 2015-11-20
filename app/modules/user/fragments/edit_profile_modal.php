<div class="modal fade animated" id="edit-profile" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title text-center">Update your profile picture so they know it's you</h4>
                </div>
                <div class="modal-body">

                    <form action="process/forms/profile.php" method="post" enctype="multipart/form-data">
                        
                        <input name="action" value="profile_picture" hidden/>
                        <input name="img" type="file">
                                        <br>                    
                        <div class="row">
                            <div class="col-xs-12">
                                
                                <button type="submit" class="btn btn-success btn-block"><i class="fa fa-upload"></i> Upload</button>
                            </div>
                        </div>
                    </form>             
                        
                    </div>
                    
                        
                </div>
            </div>
        </div>
    