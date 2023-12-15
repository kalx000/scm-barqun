<template>
  <div>
    <Navbar />
    <Footer />
    <v-card-text>
      <v-data-table
        :headers="headers"
        :items="items"
        sort-by="price"
        class="elevation-2 pa-4"
        :loading="isLoading"
        loading-text="Loading... Please wait"
      >
        <template v-slot:top>
          <v-toolbar flat>
            <v-toolbar-title>Customer</v-toolbar-title>
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
                            v-model="editedItem.nama_customer"
                            label="Customer Name"
                            prepend-icon="mdi-account-outline"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="6">
                          <v-text-field
                            v-model="editedItem.email"
                            label="Email"
                            prepend-icon="mdi-email-outline"
                          ></v-text-field>
                        </v-col>
                      </v-row>

                      <v-row>
                        <v-col cols="6">
                          <v-text-field
                            v-model="editedItem.nomor_telepon"
                            label="Phone Number"
                            prepend-icon="mdi-phone-dial-outline"
                            @keypress="onlyNumber" type="text"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="6">
                          <v-text-field
                            v-model="editedItem.alamat"
                            label="Address"
                            prepend-icon="mdi-map-marker-outline"
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
      <v-snackbar
           v-model="snackbar1"
           absolute
          top
          color="success"
          outlined
          right
          timeout= 1500
           >
            The Data Successfully Add
          </v-snackbar>
          <v-snackbar
           v-model="snackbar2"
            absolute
          top
          color="orange"
          outlined
          right
          timeout = 1500
           >
            The Data Successfully Edit
          </v-snackbar>
          <v-snackbar
           v-model="snackbar3"
            absolute
          top
          color="error"
          outlined
          right
          timeout = 1500
           >
            The Data Successfully Delete
          </v-snackbar>
    </v-card-text>
  </div>
</template>
<script>
import axios from "axios";
import Navbar from "@/components/NavBar.vue";
import Footer from "@/components/Footer.vue";
export default {
  components: {
    Navbar,
    Footer,
  },
  data: () => ({
    tab: null,
    dialog: false,
    dialogDelete: false,
    formTitle: "",
    snackbar1: false,
    snackbar2: false,
    snackbar3: false,
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
    isLoading: false,
    items: [],
    editedIndex: -1,
    editedItem: {
      nama_customer: "",
      email: "",
      nomor_telepon: "",
      alamat: "",
    },
    defaultItem: {
      nama_customer: "",
      email: "",
      nomor_telepon: "",
      alamat: "",
    },
  }),

  methods: {
    editItem(item) {
      this.formTitle = "Edit Customer";
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },
    deleteItem(item) {
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },
    deleteItemConfirm() {
      const index = this.items.indexOf(this.editedItem);
      this.items.splice(index, 1);
      this.closeDelete();
    },
    save() {
      if (this.formTitle === "Add Customer") {
        this.items.push(Object.assign({}, this.editedItem));
      } else {
        const index = this.items.indexOf(this.editedItem);
        this.items.splice(index, Object.assign({}, this.editedItem));
      }
      this.close();
      this.snackbar = true;
    },
    close() {
      this.dialog = false;
      this.clearEditedItem();
    },
    closeDelete() {
      this.dialogDelete = false;
      this.clearEditedItem();
    },
    clearEditedItem() {
      this.editedItem = {};
    },

    onlyNumber ($event) {
   //console.log($event.keyCode); //keyCodes value
   let keyCode = ($event.keyCode ? $event.keyCode : $event.which);
   if ((keyCode < 48 || keyCode > 57) && keyCode !== 46) { // 46 is dot
      $event.preventDefault();
   }
},

    async save() {
      try {
        const headers = {
          Authorization: `Bearer 29|LLsaDlynLAwnMMuURjsi7R59bCxdIIi3tq6no7va`,
          "Content-Type": "application/json",
        };

        console.log("Form Title:", this.formTitle);
        console.log("Edited Item:", this.editedItem);

        if (this.formTitle === "Add Customer") {
          console.log("Sending POST request...");
          await axios.post(
            "http://127.0.0.1:8081/api/customer",
            this.snackbar1 = true,
            this.editedItem,
            { headers }
          );
        } else {
          console.log("Sending PUT request...");
          await axios.put(
            `http://127.0.0.1:8081/api/customer/${this.editedItem.id}`,
            this.snackbar2 = true,
            this.editedItem,
            { headers }
          );
        }

        console.log("Request successful!");
      } catch (error) {
        console.error("Error saving data:", error);
      }
    },

    async deleteItem(item) {
      try {
        const headers = {
          Authorization: "Bearer 29|LLsaDlynLAwnMMuURjsi7R59bCxdIIi3tq6no7va",
        };
        await axios.delete(`http://127.0.0.1:8081/api/customer/${item.id}`, {
          headers,
        });
        this.snackbar3 = true;
        await this.fetchData();

        this.closeDelete();
      } catch (error) {
        console.error("Error deleting item:", error);
      }
    },

    async fetchData() {
      try {
        const headers = {
          Authorization: `Bearer 29|LLsaDlynLAwnMMuURjsi7R59bCxdIIi3tq6no7va`,
        };
        const response = await axios.get("http://127.0.0.1:8081/api/customer", {
          headers,
        });
        this.items = response.data.data;
      } catch (error) {
        console.error("Error fetching data:", error);
      } finally{
        this.isLoading = false;
      }
    },
  },
  mounted() {
    this.fetchData();
    this.isLoading = true;
  },
};
</script>

<style>
</style>
