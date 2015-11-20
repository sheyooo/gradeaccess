<div class="modal fade animated" id="add-behaviour" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title text-center"> Write a comment about <?php echo $profile->getFirstName(); ?> </h4>
                </div>
                <div class="modal-body">

                    <form action="process/workers/ajax_update_behaviour.php" method="post" enctype="multipart/form-data">
                        
                        <input name="action" value="behaviour_update_modal" hidden/>
                        <input name="studId" value="<?php echo $profile->getID() ?>" hidden/>
                        <input name="referer" value="modal_profile" hidden/>
                        <label for="behaviour">Behaviour</label>
                        <textarea class="form-control" name="behaviour" placeholder="What did you observe?" rows="4"> </textarea>
                        <br>

                        <label for="type">Kind of behaviour</label>
                        <select class="form-control" name="type">
                            <option value="1">Positive behaviour</option>
                            <option value="0">Negative behaviour</option>
                        </select>
                                         <br>                    
                        <div class="row">
                            <div class="col-xs-12">
                                
                                <button type="submit" class="btn btn-success btn-block"><i class="fa fa-send"></i> Send</button>
                            </div>
                        </div>
                    </form>             
                        
                    </div>
                    
                        
                </div>
            </div>
        </div>
    