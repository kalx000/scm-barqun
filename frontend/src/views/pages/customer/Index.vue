INDEX.VUE

<template>
  <v-app>
    <v-data-table
      :headers="headers"
      :items="desserts"
      sort-by="price"
      class="elevation-5 pa-4"
      style="margin-top:70px;"
    >
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>Customer</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>
          <v-dialog v-model="dialog" max-width="550px">
            <template v-slot:activator="{ on, attrs }">
              <v-btn color="secondary" dark class="mb-2" v-bind="attrs" v-on="on">
                <v-icon>fas fa-plus</v-icon>
                Add
              </v-btn>
            </template>
            <v-card>
              <v-card-title>
                <span class="text-h5">{{ formTitle }}</span>
              </v-card-title>

              <v-card-text>
                <v-container>
                  <!-- <ModuleForm :form="editedItem" />  -->
                  <v-row>
                    <!-- <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="form.idcustomer"
                        label="ID Customer"
                      ></v-text-field>
                    </v-col> -->
                    <v-row>
                      <v-col cols="6">
                        <v-text-field
                          v-model="editedItem.name"
                          label="Customer Name"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="6">
                        <v-text-field
                          v-model="editedItem.email"
                          label="Email"
                        ></v-text-field>
                      </v-col>
                    </v-row>

                    <v-row>
                      <v-col cols="6">
                        <v-text-field
                        @keypress="filter(event)"
                          v-model="editedItem.telepon"
                          label="Phone Number"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="6">
                        <v-text-field
                          v-model="editedItem.alamat"
                          label="Address"
                        ></v-text-field>
                      </v-col>
                    </v-row>
                  </v-row>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="secondary" text @click="close"> Cancel </v-btn>
                <v-btn color="secondary" text @click="save"> Save </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
          <v-dialog v-model="dialogDelete" max-width="500px">
            <v-card>
              <v-card-title class="text-h5"
                >Are you sure you want to delete this item?</v-card-title
              >
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="secondary" text @click="closeDelete"
                  >Cancel</v-btn
                >
                <v-btn color="secondary" text @click="deleteItemConfirm"
                  >OK</v-btn
                >
                <v-spacer></v-spacer>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-toolbar>
      </template>
      <template v-slot:[`item.actions`]="{ item }">
        <v-icon small class="mr-2" @click="editItem(item)"> mdi-pencil </v-icon>
        <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon>
      </template>
      <template v-slot:no-data>
        <v-btn color="secondary" @click="initialize"> Reset </v-btn>
      </template>
    </v-data-table>
  </v-app>
</template>
<script>
// import ModuleForm from "./Form.vue";
export default {
  // components: { ModuleForm },
  data: () => ({
    tab: null,
    dialog: false,
    dialogDelete: false,
    headers: [
      // {
      //   text: "ID Customer",
      //   align: "start",
      //   sortable: true,
      //   value: "idcustomer",
      // },
      {
        text: "Customer Name",
        align: "start",
        sortable: "true",
        value: "name",
      },
      { text: "Email", value: "email" },
      { text: "Phone Number", value: "telepon" },
      { text: "Address", value: "alamat" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    desserts: [],
    editedIndex: -1,
    editedItem: {
      idcustomer: "",
      name: "",
      email: "",
      telepon: "",
      alamat: "",
    },
    defaultItem: {
      idcustomer: "",
      name: "",
      email: "",
      telepon: "",
      alamat: "",
    },
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Item" : "Edit Item";
    },
  },

  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },

  created() {
    this.initialize();
  },

  methods: {
    initialize() {
      this.desserts = [
        {
          idcustomer: "91290928",
          name: "Barqun Digital Teknologi",
          email: "marketing@barqun.com",
          telepon: "081387229453",
          alamat: "Jl. Kadrie Oening No. 1",
        },
        {
          idcustomer: "91290928",
          name: "Barqun Digital Teknologi",
          email: "marketing@barqun.com",
          telepon: "081387229453",
          alamat: "Jl. Kadrie Oening No. 1",
        },
        {
          idcustomer: "91290928",
          name: "Barqun Digital Teknologi",
          email: "marketing@barqun.com",
          telepon: "081387229453",
          alamat: "Jl. Kadrie Oening No. 1",
        },
        {
          idcustomer: "91290928",
          name: "Barqun Digital Teknologi",
          email: "marketing@barqun.com",
          telepon: "081387229453",
          alamat: "Jl. Kadrie Oening No. 1",
        },
        {
          idcustomer: "91290928",
          name: "Barqun Digital Teknologi",
          email: "marketing@barqun.com",
          telepon: "081387229453",
          alamat: "Jl. Kadrie Oening No. 1",
        },
        {
          idcustomer: "91290928",
          name: "Barqun Digital Teknologi",
          email: "marketing@barqun.com",
          telepon: "081387229453",
          alamat: "Jl. Kadrie Oening No. 1",
        },
      ];
    },

    filter: function (evt) {
    evt = evt ? evt : window.event;
    let expect = evt.target.value.toString() + evt.key.toString();

    if (!/^[-+]?[0-9]*\.?[0-9]*$/.test(expect)) {
      evt.preventDefault();
    } else {
      return true;
    }
  },

    editItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
      this.desserts.splice(this.editedIndex, 1);
      this.closeDelete();
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        ``;
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.desserts[this.editedIndex], this.editedItem);
      } else {
        this.desserts.push(this.editedItem);
      }
      this.close();
    },
  },
};
</script>

<style>
</style>
