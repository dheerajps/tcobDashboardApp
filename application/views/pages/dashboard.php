<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            
            <div class="ex-sub-header clearfix">
                <div class="container-fluid">
                    <div class="pull-left">
                        <div class="ex-sub-header--gadgets">
                            <a class="btn ex-btn ex-btn__active" href="add" title="Add student" data-toggle="modal" data-target=".add-student" data-placement="bottom" role="button">
                                <i class="icon icon-plus"></i> Add student
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-4 pull-right">
                        <form class="search" role="form">
                            <label for="txt-search" class="sr-only">Search</label>
                            <div class="input-group">
                                <input id="txt-search" type="text" class="form-control ex-form-control__inverse" placeholder="Search">
                                <span class="input-group-btn">
                                    <button class="btn btn-info btn-search"><i class="icon icon-inverse icon-search"></i></button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>            
            
            
            <?php
            if($this->session->flashdata("success") != NULL){

                echo "<div class='alert alert-success'>";
                echo "\t<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
                echo $this->session->flashdata("success");
                echo "</div>";
            }
            ?>
            <br>
            <ul class="nav nav-tabs nav-tabs" role="tablist">
                <li class="active"><a href="#active" role="tab" data-toggle="tab">Active</a></li>
                <li><a href="#alumni" role="tab" data-toggle="tab">Alumni</a></li>
            </ul>
            
            <h1>Students</h1>
                        
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Program</th>
                    <th>Status</th>
                    <th>#</th>
                    <th>PawPrint</th>
                </tr>
                </thead>
                <tbody>

                    <tr>
                        <td><a href="student" title="View or edit record">Hogan, Grant L.</a></td>
                        <td>Management</td>
                        <td>Active</td>
                        <td>00000002</td>
                        <td>hogang</td>
                    </tr>  
                    <tr>
                        <td><a href="student" title="View or edit record">Hogan, Kerri M.</a></td>
                        <td>Finance</td>
                        <td>Active</td>
                        <td>00000001</td>
                        <td>hogank</td>
                    </tr>

                    <tr>
                        <td><a href="student" title="View or edit record">Hogan, Shahn A.</a></td>
                        <td>Marketing</td>
                        <td>Active</td>
                        <td>00000000</td>
                        <td>hogansa</td>
                    </tr>                                                          
                </tbody>
            </table>
            
            <div class="text-center">
                <div class="btn-group">
                    <div class="btn-group dropdown">
                        <button type="button" id="dropdownMenu1" class="btn-link btn dropdown-toggle" data-toggle="dropdown">10 per page <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                            <li role="presentation" class="dropdown-header">Show up to</li>
                            <li role="presentation" class="active"><a role="menuitem" tabindex="-1" href="#">10 items</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">25 items</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">50 items</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">100 items</a></li>
                        </ul>
                    </div>

                </div> 
                
                <div class="btn-group">
                    <!--<a class="btn btn-default" href="#"><i class="icon icon-angle-left"></i></a>-->
                    <a class="btn btn-default active" href="#">1</a>
                    <a class="btn btn-default" href="#">2</a>
                    <a class="btn btn-default" href="#">3</a>
                    <a class="btn btn-default" href="#">4</a>
                    <a class="btn btn-default" href="#"><i class="icon icon-angle-right"></i></a>
                </div> 
                
                <div class="btn-group">
                    <div class="btn-group dropdown">
                        <button type="button" id="dropdownMenu2" class="btn-link btn dropdown-toggle" data-toggle="dropdown">Page 1 of 4 <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu2">
                            <li role="presentation" class="dropdown-header">Jump to page</li>
                            <li class="padding-left-2 padding-right-2 padding-top-1 padding-bottom-1" role="presentation">
                                <form action="">
                                    <div class="input-group">
                                        <input type="text" placeholder="3" class="form-control"/>
                                        <div class="input-group-btn">
                                            <button class="btn btn-default">Go</button>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </div>                
                </div>               
            </div>
            
            <!--<button class="btn btn-default" data-toggle="modal" data-target=".add-student">
            Show modal
            </button>-->
            
            <div class="modal fade in add-student">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Add Student</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" class="">
                            <div class="form-group">
                                <label for="studentNumber" class="control-label required">Student #</label>
                                <input type="text" class="form-control" id="studentNumber">
                            </div>
                            <div class="form-group">
                                <label for="lastName" class="control-label required">Last Name</label>
                                <input type="text" class="form-control" id="lastName">
                            </div>
                            <div class="form-group">
                                <label for="firstName" class="control-label required">First Name</label>
                                <input type="text" class="form-control" id="firstName">
                            </div>            
                            <div class="form-group">
                                <label for="middleName" class="control-label required">Middle Name</label>
                                <input type="text" class="form-control" id="middleName">
                            </div>                
                            <div class="form-group">
                                <label for="pawprint" class="control-label">Pawprint</label>
                                <input type="text" class="form-control" id="pawprint">
                            </div>            
                            <div class="form-group">
                                <label for="program" class="control-label">Program</label>
                                    <select required aria-required="true" id="program" class="form-control">
                                        <option value=""></option>
                                        <option>Accountancy</option>
                                        <option>Finance</option>
                                        <option>Management</option>
                                        <option>Marketing</option>
                                    </select>
                            </div>                                                                                     
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="pull-left btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-default">Save</button>
                    </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>