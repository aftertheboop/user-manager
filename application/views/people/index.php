<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h1>People Manager</h1> <a href="/auth/logout" class="btn btn-default pull-right input-sm">Log out</a>
    
    <button id="addPerson" class="btn btn-success" data-toggle="modal" data-target="#createModal"><span class="glyphicon glyphicon-plus"></span> Add Person</button>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Mobile Number</th>
                <th>Email</th>
                <th>Language</th>
                <th>Date of Birth</th>
                <th width="150"></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            
            <?php 
            
            
            if($people) {
                foreach($people as $person) {

                    $this->load->view('people/person', array('data' => $person));

                } 
            } else {
                echo '<tr><td colspan="8" class="text-center">Table is empty</td></tr>';
            }
?>
        </tbody>
    </table>
    <nav aria-label="Page navigation">
        <ul class="pagination">
    <?php echo $this->pagination->create_links(); ?>
        </ul>
    </nav>
    
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Add a new person</h4>
        </div>
        <form id="addPersonForm">
            <div class="modal-body">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" value="" required />
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" value="" required />
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile Number</label>
                        <input type="number" name="mobile" id="mobile" class="form-control" value="" number required />
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="" required placeholder="you@example.com" />
                    </div>
                    <div class="form-group">
                        <label for="language">Language</label>
                        <select name="language" id="language" class="form-control" required>
                            <option></option>
                            <?php foreach($languages as $language) { ?>
                            <option value="<?php echo $language->id ?>"><?php echo $language->name ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="text" name="dob" id="dob" class="form-control" value="" required placeholder="YYYY-MM-DD" />
                    </div>
            </div>
            <div class="modal-footer">
                <img src="/img/ajax-loader.gif" class="addLoading" />
              <button type="button" class="btn btn-default close-modal" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-success" value="Save Person" />
            </div>
        </form>
      </div>
    </div>
  </div>
    
    
</div>