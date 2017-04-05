<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h1>People Manager</h1>
    
    <button class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Add Person</button>
    
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
            <?php foreach($people as $person) {
                
                $this->load->view('people/person', array('data' => $person));
                
            } ?>
        </tbody>
    </table>
    
</div>