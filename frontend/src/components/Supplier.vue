<template>
  <div>
    <Navbar/>
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
          <v-toolbar-title>Manage Supplier</v-toolbar-title>
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
                @click="formTitle = 'Add Supplier'"
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
                          v-model="editedItem.nama_supplier"
                          label="Supplier Name"
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
                          @keypress="filter(event)"
                          v-model="editedItem.telepon"
                          label="Phone Number"
                          prepend-icon="mdi-phone-dial-outline"
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
import axios from 'axios';
import Navbar from "../components/NavBar.vue"
export default {
  components:{
    Navbar,
  },
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
    isLoading: true,
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
    editItem(item) {
      this.formTitle = "Edit supplier";
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

    //get data
      async fetchData() {
        try {
          const headers = {
            Authorization: `Bearer 3|mZIUwp6JDcvKP4QB2H43dPJm22xCfY2UrtYRJ3k4`,
          };
          const response = await axios.get("http://127.0.0.1:8081/api/supplier", { headers, });
          this.items = response.data.data;
        } catch (error) {
          console.error("Error fetching data:", error);
        }
      },

    //post n put data
    async save() {
      try {
        const headers = {
          Authorization: `Bearer 3|mZIUwp6JDcvKP4QB2H43dPJm22xCfY2UrtYRJ3k4`,
          "Content-Type": "application/json",
        };

        if (this.formTitle === "Add Supplier") {
          console.log("Sending POST request...");
            console.log(this.editedItem);

          const response = await axios.post(
            "http://127.0.0.1:8081/api/supplier",
            this.editedItem,
            { headers }
          );axios.get(
            "http://127.0.0.1:8081/api/supplier",
            { headers }
          ).then((response) => {
            this.items = response.data.data
            this.dialog = false
          }).catch((error)=>{
          console.log(error.response);
          })

          this.editedItem.id = response.data.id;
        } else {
          console.log("Sending PUT request...");
          await axios.put(
            `http://127.0.0.1:8081/api/supplier/${this.editedItem.id}`,
            this.editedItem,
            { headers }
          );
          axios.get(
            "http://127.0.0.1:8081/api/supplier",
            { headers }
          ).then((response) => {
            this.items = response.data.data
            this.dialog = false
          }).catch((error)=>{
          console.log(error.response);
          })
        }

        console.log("Request successful!");
      } catch (error) {
        console.error("Error saving data:", error.response);
      }
    },

    //delete data
    async deleteItem(item) {
      try {
        const headers = {
          Authorization: "Bearer 3|mZIUwp6JDcvKP4QB2H43dPJm22xCfY2UrtYRJ3k4",
        };
        await axios.delete(`http://127.0.0.1:8081/api/supplier/${item.id}`, {
          headers,
        });
        await this.fetchData();

        this.closeDelete();
      } catch (error) {
        console.error("Error deleting item:", error);
      }
    },

  },
  mounted() {
    axios
  .get("http://127.0.0.1:8081/api/supplier", {
    headers: {
      Authorization: "Bearer 1|9kDguz3xKqt0JZ7NaKGBa6QaJUHMIKtXUIXRySSk", // Add the token here
    },
  })
  .then((response) => {
    this.items = response.data.data;
    this.isLoading = false;
    console.log(this.items);
  })
  .catch((error) => console.log(error));
  },
};
</script>

<style>
/* .v-list-item--link:before{
  background-color: #1976D2; 
  z-index: 2;
}
.v-list-item__title{
  z-index: 1;  
} */
</style>