INDEX.VUE

<template>
  <v-app>
    <v-data-table
      :headers="headers"
      :items="items"
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
                <v-icon left>fas fa-plus</v-icon>
                Add
              </v-btn>
            </template>
            <v-card>
              <v-card-title>
                <span class="text-h5">{{ formTitle }}</span>
              </v-card-title>

              <v-card-text>
                <v-container>
                  <v-row>
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
        <div class="align-center">
    <v-menu   
    transition="slide-y-transition"
    offset-y>
      <template v-slot:activator="{ on, attrs }">
        <v-btn icon
          color="secondary"
          v-bind="attrs"
          v-on="on"
        >
          <v-icon>fas fa-ellipsis-vertical</v-icon>
        </v-btn>
      </template>
      <v-list>
        <v-list-item @click="deleteItem(item)">
            <v-icon style="color:red;" small class="mr-2">fa-solid fa-trash</v-icon>
            <v-list-item-title>Delete</v-list-item-title>  
        </v-list-item>
        <v-list-item @click="editItem(item)">
            <v-icon style="color:orange;" small class="mr-2">fa-solid fa-pen</v-icon>
            <v-list-item-title>Edit</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>
  </div>
      </template>
    </v-data-table>
  </v-app>
</template>
<script>
import axios from "axios";
export default {
  data: () => ({
    tab: null,
    dialog: false,
    dialogDelete: false,
    headers: [
      {
        text: "Customer Name",
        align: "start",
        sortable: "true",
        value: "nama_customer",
      },
      { text: "Email", value: "email" },
      { text: "Phone Number", value: "nomor_telepon" },
      { text: "Address", value: "alamat" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    items: [],
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
      return this.editedIndex === -1 ? "New Customer" : "Edit Customer";
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
      this.editedIndex = this.items.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      this.editedIndex = this.items.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
      this.items.splice(this.editedIndex, 1);
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
        Object.assign(this.items[this.editedIndex], this.editedItem);
      } else {
        this.items.push(this.editedItem);
      }
      this.close();
    },
  },
  mounted() {
    axios
      .get("http://127.0.0.1:8081/api/customers")
      .then((response) => {
        this.items = response.data.data;
        console.log(this.items);
      })
      .catch((error) => console.log(error));
  },
};
</script>

<style>
</style>
