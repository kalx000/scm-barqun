<template>
  <v-app>
    <v-data-table
      :headers="headers"
      :items="items"
      sort-by="price"
      class="elevation-5 pa-4"
      style="margin-top: 70px"
    >
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>Supplier</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>
          <v-dialog v-model="dialog" max-width="550px">
            <template v-slot:activator="{ on, attrs }">
              <v-btn
                color="secondary"
                dark
                class="mb-2"
                v-bind="attrs"
                v-on="on"
              >
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
                          label="Supplier Name"
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
          <v-menu transition="slide-y-transition" offset-y>
            <template v-slot:activator="{ on, attrs }">
              <v-btn icon color="secondary" v-bind="attrs" v-on="on">
                <v-icon>fas fa-ellipsis-vertical</v-icon>
              </v-btn>
            </template>
            <v-list>
              <v-list-item @click="deleteItem(item)">
                <v-icon style="color: red" small class="mr-2"
                  >fa-solid fa-trash</v-icon
                >
                <v-list-item-title>Delete</v-list-item-title>
              </v-list-item>
              <v-list-item @click="editItem(item)">
                <v-icon style="color: orange" small class="mr-2"
                  >fa-solid fa-pen</v-icon
                >
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
import axios from 'axios';
export default {
  data: () => ({
    dialog: false,
    dialogDelete: false,
    items: [{ icon: "mdi-delete", text: "delete" }, { icon: "mdi-pencil" }],
    headers: [
      { text: "Supplier Name", sortable: true, value: "nama_supplier", },
      { text: "Email", value: "email" },
      { text: "Phone", value: "nomor_telepon" },
      { text: "Address", value: "alamat" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    items: [],
    editedIndex: -1,
    editedItem: {
      name: "",
      email: "",
      phone: "",
      address: "",
    },
    defaultItem: {
      name: "",
      email: "",
      phone: "",
      address: "",
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
    // this.initialize();
  },

  methods: {
    async fetchData() {
      try{
        this.loading = true;
        const response = await axios.get('http://127.0.0.1:8081/api/product', 
        "Bearer 2|hInFYkOHIslnRBsSwW5in9AcQJZArYjVz0XJrNPz");
        const data = response.data.data;
        console.log(data);
        this.items.lists = data;
      } catch (error){
        console.error(error.message);
      }finally {
        this.loading = false;
      }
    },
    
    async save(data) {
      try{
        const response = await axios.post('http://127.0.0.1:8081/api/product', data,
        "Bearer 2|hInFYkOHIslnRBsSwW5in9AcQJZArYjVz0XJrNPz");
        console.log(response.data.message);
        this.fetchData();
        this.dialog = false;
        this.sbData.sbColor = 'success';
        this.sbData.sbMsg = response.data.message;
        this.sbData.sbIcon = 'mdi-check';
        this.$refs.snackbar.show();
      } catch (error) {
        console.log(error);
        this.sbData.sbColor = 'error';
        this.sbData.sbMsg = error.response.data.message;
        this.sbData.sbIcon = 'mdi-alert-circle-outline';
        this.$refs.snackbar.show();
      }
    },

    async edit(data) {
      try{
        const response = await axios.put(`http://127.0.0.1:8081/api/product/${data.id}`, data,
        "Bearer 2|hInFYkOHIslnRBsSwW5in9AcQJZArYjVz0XJrNPz");
        console.log(response.data.message);
        this.fetchData();
        this.dialog = false;
        this.sbData.sbColor = 'success';
        this.sbData.sbMsg = response.data.message;
        this.sbData.sbIcon = 'mdi-check';
        this.$refs.snackbar.show();
      } catch (error) {
        console.log(error);
        this.sbData.sbColor = 'error';
        this.sbData.sbMsg = error.response.data.message;
        this.sbData.sbIcon = 'mdi-alert-circle-outline';
        this.$refs.snackbar.show();
      }
    },

    async destroy(data) {
      try{
        const response = await axios.delete(`http://127.0.0.1:8081/api/product/${data.id}`, 
        "Bearer 2|hInFYkOHIslnRBsSwW5in9AcQJZArYjVz0XJrNPz");
        console.log(response.data.message);
        this.fetchData();
        this.dialog = false;
        this.sbData.sbColor = 'success';
        this.sbData.sbMsg = response.data.message;
        this.sbData.sbIcon = 'mdi-check';
        this.$refs.snackbar.show();
      } catch (error) {
        console.log(error);
        this.sbData.sbColor = 'error';
        this.sbData.sbMsg = error.response.data.message;
        this.sbData.sbIcon = 'mdi-alert-circle-outline';
        this.$refs.snackbar.show();
      }
    },

  

    // editItem(item) {
    //   this.editedIndex = this.items.indexOf(item);
    //   this.editedItem = Object.assign({}, item);
    //   this.dialog = true;
    // },

    // deleteItem(item) {
    //   this.editedIndex = this.items.indexOf(item);
    //   this.editedItem = Object.assign({}, item);
    //   this.dialogDelete = true;
    // },

    // deleteItemConfirm() {
    //   this.items.splice(this.editedIndex, 1);
    //   this.closeDelete();
    //   this.snackbar2 = true;
    // },
    // save() {
    //   if (this.editedIndex > -1) {
    //     Object.assign(this.items[this.editedIndex], this.editedItem);
    //   } else {
    //     this.items.push(this.editedItem);
    //   }
    //   this.close();
    //   this.snackbar1 = true;
    // },
  },

  mounted() {
axios
  .get("http://127.0.0.1:8081/api/supplier", {
    headers: {
      Authorization: "Bearer 2|WhjHcMkCyLhkqLDHG65actezjIvez342WkC9c1HV", // Add the token here
    },
  })
  .then((response) => {
    this.items = response.data.data;
    console.log(this.items);
    this.isLoading = false;
  })  
  .catch((error) => console.log(error));

  },
};
</script>

<style>
</style>
