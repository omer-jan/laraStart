<template>
  <div>
    <div class="">
      <div class="row mt-3">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Users List</h3>

              <div class="card-tools">
                <button class="btn btn-success" data-toggle="modal" data-target="#addUserModel">
                  <i class="fas fa-user-plus fa-fw"></i>
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

                <tr v-for="user in users" :key="user.id">
                  <td>{{user.id}}</td>
                  <td>{{user.name | upText }}</td>
                  <td>{{user.email}}</td>
                  <td>{{user.type | upText}}</td>
                    <td>{{user.created_at | mydate}}</td>

                  <td>
                    <a href="#">
                      <i class="fa fa-edit blue"></i>
                    </a>
                    <a href="#">
                      <i class="fa fa-trash red"></i>
                    </a>
                  </td>
                </tr>

              </tbody></table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
    <div class="modal fade" id="addUserModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <form @submit.prevent="createUser">
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
        <button type="submit" class="btn btn-primary">Create</button>
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
        users:{},
        form: new Form({
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
      createUser()
      {
         this.$Progress.start();
         this.form.post('api/user');
          // we create a custom event
         Fire.$emit('AfterCreate');// this line will call an event its name is AfterCreate
          $('#addUserModel').modal('hide');


         Toast.fire({
           type: 'success',
           title:'User Creatd Successfully',
           animation: true,
         })
         this.$Progress.finish();
      },
      loadUsers()
      {
       axios.get("api/user").then(({data})=>(this.users=data.data));

      }


    }

  }

</script>
