<style>
  .widget-user-header{
    background-position: center center;
    background-size: cover;
    height: 250px !important;
  }
  .widget-user .card-footer{
    padding: 0;
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
                <h3 class="widget-user-username">{{this.form.name}}</h3>
                <h5 class="widget-user-desc">{{this.form.type}}</h5>
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

                        <div class="col-sm-12">
                          <input type="" v-model="form.name" class="form-control" id="inputName" placeholder="Name" :class="{ 'is-invalid': form.errors.has('name') }">
                          <has-error :form="form" field="name"></has-error>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-12">
                          <input type="email" v-model="form.email" class="form-control" id="inputEmail" placeholder="Email"  :class="{ 'is-invalid': form.errors.has('email') }">
                          <has-error :form="form" field="email"></has-error>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                        <div class="col-sm-12">
                          <textarea  v-model="form.bio" class="form-control" id="inputExperience" placeholder="Experience" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                          <has-error :form="form" field="bio"></has-error>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="photo" class="col-sm-2 control-label">Profile Photo</label>
                        <div class="col-sm-12">
                          <input type="file" @change="updateProfile" name="photo" class="form-input">
                        </div>

                      </div>
                      <div class="form-group">
                                   <label for="password" class="col-sm-12 control-label">Passport (leave empty if not changing)</label>

                                   <div class="col-sm-12">
                                   <input type="password"
                                       v-model="form.password"
                                       class="form-control"
                                       id="password"
                                       placeholder="Passport"
                                       :class="{ 'is-invalid': form.errors.has('password') }"
                                   >
                                    <has-error :form="form" field="password"></has-error>
                                   </div>
                               </div>



                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" @click.prevent="updateInfo" class="btn btn-success">Update</button>
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

<script>
  export default
  {
    data() {
      return {
        editmode:true,// if it is true it mean we are edting and if it is flase it mean we are add new
        users:{},
        form: new Form({
          id:'',
          name: '',
          email: '',
          password: '',
          bio: '',
          photo: '',
          type: '',
        })

      }
    },
    created()
    {
      // axios.get("api/profile")
      // .then(({data})=>{ alert("i am back")});
      axios.get("api/profile").then(({data})=>(this.form.fill(data)));
    },
    methods:
    {
      updateProfile(e){


        //let file = e.target.files[0];
        let file = e.target.files[0];//get the file
        //check the file size
        //  if(file['size']< 2111775) // it mean file size is less then 2 mega bits
        if(file['size']< 3111775) // it mean file size is less then 2 mega bits
        {
          //file size is less then 2 mega bits
          // the below lines will convert it to base 64
          let reader = new FileReader();//create a file reader
          reader.onloadend = (file) =>
          {
            this.form.photo = reader.result;
          }
          reader.readAsDataURL(file); // the reader will read our file and we pass our file to it

        }
        else
        {
          // file size is more then 2 mega bite and let the use know that he cant upload this
          swal.fire
          ({
            type:'toast',
            title:'Opps...!',
            text:'Your file size is more then 2 MB',
            type:'error',
            showConfirmButton: false,
            timer: 1500,
            showConfirmButton: false,
          });
        }


      },
      updateInfo(){
        this.$Progress.start();
        this.form.put('api/profile')
        .then(()=>{

          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();

        });
      }
    },
  }


</script>
