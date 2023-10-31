<template>
  <div>
    <v-row>
      <!-- <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="form.idcustomer"
                        label="ID Customer"
                      ></v-text-field>
                    </v-col> -->
      <v-col cols="12" sm="6" md="4">
        <v-text-field v-model="form.name" label="Name Customer"></v-text-field>
      </v-col>
      <v-col cols="12" sm="6" md="4">
        <v-text-field v-model="form.email" label="Email"></v-text-field>
      </v-col>
      <v-col cols="12" sm="6" md="4">
        <v-text-field v-model="form.telepon" label="No Telepon"></v-text-field>
      </v-col>
      <v-col cols="12" sm="6" md="4">
        <v-text-field v-model="form.alamat" label="Alamat"></v-text-field>
      </v-col>
    </v-row>
  </div>
</template>

<script>
export default {
  props: ["form"],
  // data() {
  //     return {
  //         form: {}
  //     }
  // },
};
</script>

<style>
</style>