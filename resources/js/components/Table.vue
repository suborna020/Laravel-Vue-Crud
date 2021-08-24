<template>
  <div>
    <div>List of Data</div>

    <table class="table table-bordered">
      <thead></thead>
      <tbody>
        <tr v-for="(usersData, index) in user" :key="index">
          <th scope="row">{{ index + 1 }}</th>
          <td>{{ usersData.name }}</td>
          <td>{{ usersData.email }}</td>
          <td>{{ usersData.image }}</td>
          <td>{{ usersData.gender }}</td>
          <td>
            <span
              class="badge badge-dark mx-1"
              v-for="(skill, index) in usersData.skills"
              :key="index"
            >
              {{ skill }}
            </span>
            <!-- {{ usersData.skills }} -->
          </td>

          <td class="d-flex" style="justify-content: space-between">
            <button class="mx-2" @click="$emit('editUserFunction', usersData)">
              Edit
            </button>
            <button class="mx-2" @click="$emit('deleteFunction', usersData.id)">
              Delete
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: "Table",
  emits: {
    editUserFunction: (userData) => {
      // (Validating Emitted Events) works start
      return userData;
    },
    deleteFunction: (userId) => {
      return userId;
    },
  },

  computed: {
    user() {
      return this.$store.getters["user/getUsersData"];
      //action function er data hole dispatch
    },
  },
  methods: {
    getUserOnLoad() {
      this.$store.dispatch("user/getUser");
    },
    editUserFunction(usersData) {
      console.log(usersData);
      this.form = usersData;
    },
  },

  created() {
    // page load nile akhaner function call hobe
    this.getUserOnLoad();
  },
};
</script>

<style lang="scss" scoped>
</style>