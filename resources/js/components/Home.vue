<template>
  <div class="container">
    <div class="row">
      <div class="col-sm-8 offset-md-2">
        <!-- ---------Form ------------- -->
        <div>Form Data: {{ JSON.stringify(form, null, 2) }}</div>
        <div>errors Data: {{ JSON.stringify(errors, null, 2) }}</div>
        <!-- <div>home user Data: {{ user }}</div> -->

        <form action="mail.php" method="post">
          <!-- @method('PUT') -->
          <div class="form-group row">
            <label for="staticEmail" class="col-sm-3 col-form-label"
              >Name :</label
            >
            <div class="col-sm-5">
              <input
                type="text"
                v-model="form.name"
                name="name"
                ref="inputRef"
              />
              <div class="text-danger" v-if="errors['name']">
                {{ errors["name"][0] }}
              </div>
            </div>
          </div>
          <!--  -->
          <div class="form-group row">
            <label for="" class="col-sm-3 col-form-label">Email :</label>
            <div class="col-sm-5">
              <input type="text" v-model="form.email" name="email" />
              <div class="text-danger" v-if="errors['email']">
                {{ errors["email"][0] }}
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="" class="col-sm-3 col-form-label">Image :</label>
            <div class="col-sm-5">
              <input
                type="file"
                @change="imageOnChange"
                name="image"
                ref="inputFile"
              />
              <img
                :src="`../storage/imagesFolder/${imageName}`"
                alt="image"
                width="40%"
                class="my-3"
                v-if="showImage"
              />

              <span class="text-danger" v-if="errors['image']">
                {{ errors["image"][0] }}
              </span>
            </div>
          </div>
          <div class="form-group row">
            <label for="" class="col-sm-3 col-form-label">Gender :</label>

            <div class="col-sm-6 d-flex">
              <div class="form-check form-check-inline">
                <input
                  class="form-check-input"
                  type="radio"
                  v-model="form.gender"
                  name="gender"
                  id="inlineRadio1"
                  value="male"
                />
                <label class="form-check-label" for="inlineRadio1">Male</label>
              </div>
              <div class="form-check form-check-inline">
                <input
                  class="form-check-input"
                  type="radio"
                  v-model="form.gender"
                  name="gender"
                  id="inlineRadio2"
                  value="female"
                />
                <label class="form-check-label" for="inlineRadio2"
                  >Female</label
                >
              </div>
              <span class="text-danger" v-if="errors['gender']">
                {{ errors["gender"][0] }}
              </span>
            </div>
          </div>
          <!-- gender end  -->
          <div class="form-group row">
            <label for="" class="col-sm-3 col-form-label">Skills :</label>
            <div class="col-sm-2">
              <div class="form-check form-check-inline">
                <input
                  class="form-check-input"
                  type="checkbox"
                  id="inlineCheckbox1"
                  value="laravel"
                  v-model="form.skills"
                  name="skills"
                />
                <label class="form-check-label" for="inlineCheckbox1"
                  >Laravel</label
                >
              </div>

              <div class="form-check form-check-inline">
                <input
                  class="form-check-input"
                  type="checkbox"
                  id="inlineCheckbox4"
                  value="ajax"
                  v-model="form.skills"
                  name="skills"
                />
                <label class="form-check-label" for="inlineCheckbox1"
                  >Ajax</label
                >
              </div>

              <div class="form-check form-check-inline">
                <input
                  class="form-check-input"
                  type="checkbox"
                  id="inlineCheckbox5"
                  value="mysql"
                  v-model="form.skills"
                  name="skills"
                />
                <label class="form-check-label" for="inlineCheckbox1"
                  >MySQL</label
                >
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-check form-check-inline">
                <input
                  class="form-check-input"
                  type="checkbox"
                  id="inlineCheckbox3"
                  value="codeigniter"
                  v-model="form.skills"
                  name="skills"
                />
                <label class="form-check-label" for="inlineCheckbox2"
                  >Codeigniter</label
                >
              </div>
              <div class="form-check form-check-inline">
                <input
                  class="form-check-input"
                  type="checkbox"
                  id="inlineCheckbox4"
                  value="vue_js"
                  v-model="form.skills"
                  name="skills"
                />
                <label class="form-check-label" for="inlineCheckbox2"
                  >VUE JS</label
                >
              </div>
              <div class="form-check form-check-inline">
                <input
                  class="form-check-input"
                  type="checkbox"
                  id="inlineCheckbox6"
                  value="api"
                  v-model="form.skills"
                  name="skills"
                />
                <label class="form-check-label" for="inlineCheckbox2"
                  >API</label
                >
              </div>
            </div>
          </div>
          <div class="text-danger" v-if="errors['skills']">
            {{ errors["skills"][0] }}
          </div>
          <div class="d-flex">
            <button
              v-if="!form.id"
              style="submit"
              class="ml-auto"
              @click.prevent="userRegister"
            >
              SUBMIT
            </button>
            <button
              v-else
              style="submit"
              class="ml-auto"
              @click.prevent="updateUserData"
            >
              Update SUBMIT
            </button>
          </div>
        </form>
        <!-- ---------Form End------------- -->
        <hr />
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <Table @editUserFunction="editUser" @deleteFunction="deleteData" />
        <!-- @deleteData="deleteId" -->
      </div>
    </div>
  </div>
</template>

<script>
import Table from "./Table.vue";

export default {
  name: "Home",
  components: {
    Table,
  },
  data() {
    return {
      form: {
        id: "",
        name: "",
        email: "",
        image: "",
        gender: "",
        skills: [],
      },
      errors: {},
      showImage: false,
      imageName: "",
    };
  },
  computed: {
    user() {
      return this.$store.getters["user/getUsersData"];
      //action function er data hole dispatch
    },
  },
  methods: {
    imageOnChange(e) {
      // this.form.image = this.$refs.inputFile.files[0];
      this.form.image = e.target.files[0];
      // console.log(this.form);
    },
    userRegister() {
      const data = new FormData();
      data.append("name", this.form.name);
      data.append("email", this.form.email);
      data.append("image", this.form.image);
      data.append("gender", this.form.gender);
      data.append("skills", this.form.skills);
      // console.log("getting form  data ::", data);

      axios
        .post("/candidate", data)
        .then((result) => {
          // console.log("after register a user", result);
          this.resetForm();
          this.getUserList();

          this.$message({
            message: "Submit Success",
            type: "success",
          });
        })
        .catch((errors) => {
          // console.log(errors);
          this.errors = errors.response.data.errors;
          this.$message({
            message: "Submit Failed",
            type: "success",
          });
        });
    },

    resetForm() {
      (this.form = {
        id: "",
        name: "",
        email: "",
        image: "",
        gender: "",
        skills: [],
      }),
        (this.$refs.inputFile.value = "");
      this.errors = {};
      this.showImage = false;
      this.imageName = "";
    },
    editUser(data) {
      //  closePopup(data) {
      // this.showPopup = false;
      this.$refs.inputRef.focus();
      this.form = data;
      if (this.form.image !== null) {
        this.showImage = true;
        this.imageName = this.form.image;
      }
    },

    updateUserData() {
      const userData = new FormData();
      userData.append("name", this.form.name);
      userData.append("email", this.form.email);
      userData.append("image", this.form.image);
      userData.append("gender", this.form.gender);
      userData.append("skills", this.form.skills);
      userData.append("_method", "PATCH");

      axios
        .post(`/candidate/${this.form.id}`, userData)

        .then((result) => {
          this.resetForm();
          this.getUserList();

          this.$message({
            message: "Update Success",
            type: "success",
          });
        })
        .catch((errors) => {
          //   console.log(errors);
          this.errors = errors.response.data.errors;
          this.$message({
            message: "Update Failed",
            type: "success",
          });
        });
    },
    deleteData(data) {
      this.form.id = data;
      axios
        .delete("/candidate/" + this.form.id)
        .then((result) => {
          this.getUserList();

          this.$message({
            message: "Delete Success",
            type: "success",
          });
        })
        .catch((errors) => {
          //   console.log(errors);
          this.errors = errors.response.data.errors;
          this.$message({
            message: "Delete Failed",
            type: "success",
          });
        });
    },
    getUserList() {
      this.$store.dispatch("user/getUser");
    },
  },
};
</script>
