<template>
  <div>
    <div class="">
      <div class="row mt-3">
        <div class="col-md-12">
          <div class="card" v-if="$gate.isAdmin()">
            <div class="card-header">
              <h3 class="card-title">Users List</h3>

              <div class="card-tools">
                <button class="btn btn-success" @click="newModal">
                  <i class="fas fa-user-plus fa-fw" ></i>
                  Add New
                </button>

              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>created at</th>
                    <th>Modify</th>
                </tr>

                <tr v-for="user in users.data" :key="user.id">
                  <td>{{user.id}}</td>
                  <td>{{user.name | upText }}</td>
                  <td>{{user.email}}</td>
                  <td>{{user.type | upText}}</td>
                    <td>{{user.created_at | mydate}}</td>

                  <td>
                    <a href="#" @click="EditUser(user)">
                      <i class="fa fa-edit blue"></i>
                    </a>
                    <a href="#" @click="DeleteUser(user.id)">
                      <i class="fa fa-trash red"></i>
                    </a>
                  </td>
                </tr>

              </tbody>
              </table>
            </div>
            <div class="card-footer">
              <pagination :data="users" @pagination-change-page="getResults"></pagination>
            </div>
            <!-- /.card-body -->
          </div>
          <div class="card" v-if="!$gate.isAdmin()">
            <not-found></not-found>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
    <div class="modal fade" id="addUserModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 v-show="!editmode" class="modal-title" id="exampleModalLabel">Add New User</h5>
            <h5 v-show="editmode" class="modal-title" id="exampleModalLabel">Update user info</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <form @submit.prevent="editmode ? updateUser() :createUser()">
          <div class="modal-body">
            <div class="form-group">
              <input
              placeholder="Name"
              v-model="form.name"
              type="text"
              name="email"
              class="form-control" :class="{ 'is-invalid': form.errors.has('name') }"
              >
              <has-error :form="form" field="name"></has-error>
            </div>
            <div class="form-group">
              <input
              placeholder="Email Address"
              v-model="form.email"
              type="text"
              name="email"
              class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
              <has-error :form="form" field="email"></has-error>
            </div>
            <div class="form-group">
              <textarea
              placeholder="Short bio for user (optional)"
              v-model="form.bio"
              type="text"
              name="bio"
              class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }">
            </textarea>
            <has-error :form="form" field="bio"></has-error>
          </div>
          <div class="form-group">
            <select
            name="type"
            v-model="form.type"
            id="type"
            class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
            <option value="">Select User Role</option>
            <option value="admin">Admin</option>
            <option value="user">Standard User</option>
            <option value="author">Author</option>
          </select>
          <has-error :form="form" field="type"></has-error>
        </div>
        <div class="form-group">
          <input
          placeholder="Password"
          v-model="form.password"
          type="password"
          name="password"
          id="password"
          class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
          <has-error :form="form" field="password"></has-error>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
        <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>
</template>

<script>
  export default{
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
      this.loadUsers();
      //setInterval(() =>this.loadUsers(),3000); here we send an http request each 3 second but now we will
      // do it using event
      // the below line will listen to the AfterCreate event
      Fire.$on('AfterCreate',()=>{
          this.loadUsers();
      });


    },
    methods:
    {
      getResults(page = 1) {
			axios.get('api/user?page=' + page)
				.then(response => {
					this.users = response.data;
				});
		},
      updateUser()
      {
          this.$Progress.start();
        //api/user/{user}
      this.form.put('api/user/'+this.form.id)
      .then(()=>{
        Toast.fire({
          type: 'success',
          title:'User info updated Successfully',
          animation: true,
        });

        Fire.$emit('AfterCreate');
          $('#addUserModel').modal('hide');
        this.$Progress.finish();
      })
      .catch(()=>{
        Toast.fire({
          type: 'error',
          title:'something wents wrong',
          animation: true,
        });
         this.$Progress.fail();

      });

      },
      EditUser(user)
      {
          this.editmode=true;
          this.form.fill(user);// this will fill the form
          $('#addUserModel').modal('show');

      },
      newModal()
      {
          // set edit mode to flase becase we want to add new user
          this.editmode=false;
        // before showing modal we should reset it
          this.form.reset();
          $('#addUserModel').modal('show');
      },
      DeleteUser(id)
      {
        swal.fire // show confirmation dialog box to the user
        ({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) =>
        {
          // if the user click ok delete it
              if (result.value)
              {

                this.$Progress.start(); // start showing the progess bar
                // it mean user want to delete the user
                this.form.delete('api/user/'+id)
                .then(()=>{
                  // if user delete Successfully then show user delete
                  Toast.fire({
                    type: 'success',
                    title:'User Deleted Successfully',
                    animation: true,
                  })
                //   swal.fire
                //   ({
                //   type:'toast',
                //    title:'Deleted!',
                //   text:'User has been deleted.',
                //   type:'success',
                //   showConfirmButton: false,
                //   timer: 1500,
                //   //showConfirmButton: false,
                // });
                    Fire.$emit('AfterCreate');
                    this.$Progress.finish();

                })
                .catch((message)=>{
                  console.log(message);
                  // if something wents wrong then inform the user
                  Toast.fire({
                    type: 'error',
                    title:'something wents wrong',
                    animation: true,
                  });
                   this.$Progress.fail();

                })

              }
            // in here we will sent request to server and we will process it



        })
      },
      createUser()
      {
         this.$Progress.start();
         // add validation using promis
         this.form.post('api/user')
            // if is Successfully
             .then(()=>{

               // 1- call the event
               Fire.$emit('AfterCreate');// this line will call an event its name is AfterCreate
               // 2- hide the modal
                $('#addUserModel').modal('hide');
                // 3- fire the toast message
               Toast.fire({
                 type: 'success',
                 title:'User Creatd Successfully',
                 animation: true,
               })
               // 4- finish the progress bar
               this.$Progress.finish();


             })
             // if there is something went wrongs
             .catch(()=>{
               Toast.fire({
                 type: 'error',
                 title:'something wents wrong',
                 animation: true,
               })
               this.$Progress.fail();

             });


      },
      loadUsers()
      {
        if(this.$gate.isAdmin())
        {
          axios.get("api/user").then(({data})=>(this.users=data));

        }
       

      }


    }

  }

</script>
