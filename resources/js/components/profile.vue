<style>
  .widget-user-header{
    background-position:center;
    background-size:cover;
    height:200px !important;
  }
</style>
<template>
  <div>
    <div class="">
      <div class="row mt-3">
        <div class="col-md-12">
          <div class=" ">

            <div class="card card-widget widget-user">
                     <!-- Add the bg color to the header using any of the bg-* classes -->
                     <div class="widget-user-header text-white" style="background: url('./img/photo1.png') center center;">
                       <h3 class="widget-user-username">Elizabeth Pierce</h3>
                       <h5 class="widget-user-desc">Web Designer</h5>
                     </div>
                     <div class="widget-user-image">
                       <img class="img-circle" src="" alt="User Avatar">
                     </div>
                     <div class="card-footer">
                       <div class="row">
                         <div class="col-sm-4 border-right">
                           <div class="description-block">
                             <h5 class="description-header">3,200</h5>
                             <span class="description-text">SALES</span>
                           </div>
                           <!-- /.description-block -->
                         </div>
                         <!-- /.col -->
                         <div class="col-sm-4 border-right">
                           <div class="description-block">
                             <h5 class="description-header">13,000</h5>
                             <span class="description-text">FOLLOWERS</span>
                           </div>
                           <!-- /.description-block -->
                         </div>
                         <!-- /.col -->
                         <div class="col-sm-4">
                           <div class="description-block">
                             <h5 class="description-header">35</h5>
                             <span class="description-text">PRODUCTS</span>
                           </div>
                           <!-- /.description-block -->
                         </div>
                         <!-- /.col -->
                       </div>
                       <!-- /.row -->
                     </div>
                   </div>

            <!-- /.card-body -->
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>

                  <li class="nav-item"><a class="nav-link active show" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane" id="activity">
                    <h3>this is me activity tab</h3>
                  </div>


                  <div class="tab-pane active show" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Name</label>

                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputName" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName2" class="col-sm-2 control-label">Name</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-success">Update</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>

</div>
</template>
