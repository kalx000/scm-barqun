<template>
  <div>
    <Navbar />
    <LeftBar />
    <Footer />
    <v-card-text>
      <v-data-table
        :headers="headers"
        :items="items"
        sort-by="idstock"
        class="elevation-5 pa-4"
        :loading="isLoading"
        loading-text="Loading... Please wait"
      >
        <template v-slot:top>
          <v-toolbar flat>
            <v-toolbar-title>Stock Opname</v-toolbar-title>
            <v-divider class="mx-4" inset vertical></v-divider>
            <v-spacer></v-spacer>
            <v-dialog v-model="dialog" max-width="700px">
              <template v-slot:activator="{ on, attrs }">
                <v-btn
                  color="secondary"
                  dark
                  class="mb-2"
                  v-bind="attrs"
                  v-on="on"
                  @click="formTitle = 'Add Stock Opname'"
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
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="editedItem.product_id"
                          label="Product Name"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="editedItem.inventory_id"
                          label="Warehouse Name"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="editedItem.hasil_opname"
                          label="Incoming Amount"
                          @keypress="onlyNumber" type="text"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-menu
                          v-model="menu"
                          :close-on-content-click="false"
                          :nudge-right="40"
                          transition="scale-transition"
                          offset-y
                          min-width="auto"
                        >
                          <template v-slot:activator="{ on, attrs }">
                            <v-text-field
                              v-model="editedItem.tanggal_opname"
                              label="Date Of Entry"
                              prepend-icon="mdi-calendar-range"
                              readonly
                              v-bind="attrs"
                              v-on="on"
                            ></v-text-field>
                          </template>
                          <v-date-picker
                            v-model="editedItem.tanggal_opname"
                            @input="menu = false"
                          ></v-date-picker>
                        </v-menu>
                      </v-col>
                    </v-row>
                  </v-container>
                </v-card-text>

                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="blue darken-1" text @click="close">
                    Cancel
                  </v-btn>
                  <v-btn color="blue darken-1" text @click="save"> Save </v-btn>
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
                  <v-btn color="blue darken-1" text @click="closeDelete"
                    >Cancel</v-btn
                  >
                  <v-btn color="blue darken-1" text @click="deleteItemConfirm"
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
    </v-card-text>
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
  </div>
</template>

<script>
import LeftBar from "@/components/LeftBar.vue";
import Footer from "@/components/Footer.vue";
import Navbar from "@/components/NavBar.vue";
import axios from "axios";
export default {
  components: {
    LeftBar,
    Footer,
    Navbar,
  },
  data: () => ({
    tab: null,
    dialog: false,
    dialogDelete: false,
    snackbar1: false,
    snackbar2: false,
    snackbar3: false,
    menu: false,
    formTitle: "",
    headers: [
      {
        text: "Product Name",
        align: "start",
        sortable: true,
        value: "product_id",
      },
      { text: "Stock", value: "inventory_id" },
      { text: "Date", value: "tanggal_opname" },
      { text: "Final", value: "hasil_opname" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    isLoading: false,
    items: [],
    editedIndex: -1,
    editedItem: {
      product_id: "",
      inventory_id: "",
      hasil_opname: "",
      tanggal_opname:(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
    },
    defaultItem: {
      product_id: "",
      idstock: "",
      hasil_opname: "",
      tanggal_opname: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
    },
  }),

  methods: {
    editItem(item) {
      this.formTitle = "Edit Stock Opname";
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

     onlyNumber ($event) {
   //console.log($event.keyCode); //keyCodes value
   let keyCode = ($event.keyCode ? $event.keyCode : $event.which);
   if ((keyCode < 48 || keyCode > 57) && keyCode !== 46) { // 46 is dot
      $event.preventDefault();
   }
},

    //get data
    async fetchData() {
      try {
        const headers = {
          Authorization: `Bearer 29|LLsaDlynLAwnMMuURjsi7R59bCxdIIi3tq6no7va`,
        };
        const response = await axios.get(
          "http://127.0.0.1:8081/api/stockopname",
          {
            headers,
          }
        );
        this.items = response.data.data;
      } catch (error) {
        console.error("Error fetching data:", error);
      }finally{
        this.isLoading = false;
      }
    },

    //post n put data
    async save() {
      try {
        const headers = {
          Authorization: `Bearer 29|LLsaDlynLAwnMMuURjsi7R59bCxdIIi3tq6no7va`,
          "Content-Type": "application/json",
        };

        if (this.formTitle === "Add Stock Out") {
          console.log("Sending POST request...");
          console.log(this.editedItem);

          const response = await axios.post(
            "http://127.0.0.1:8081/api/stockopname",
            this.editedItem,
            { headers }
          );
          axios
            .get("http://127.0.0.1:8081/api/stockopname", { headers })
            .then((response) => {
              this.items = response.data.data;
              this.snackbar1 = true;
              this.dialog = false;
            })
            .catch((error) => {
              console.log(error.response);
            });

          this.editedItem.id = response.data.id;
        } else {
          console.log("Sending PUT request...");
          await axios.put(
            `http://127.0.0.1:8081/api/stockopname/${this.editedItem.id}`,
            this.editedItem,
            { headers }
          );
          axios
            .get("http://127.0.0.1:8081/api/stockopname", { headers })
            .then((response) => {
              this.items = response.data.data;
              this.snackbar2 = true;
              this.dialog = false;
            })
            .catch((error) => {
              console.log(error.response);
            });
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
          Authorization: "Bearer 29|LLsaDlynLAwnMMuURjsi7R59bCxdIIi3tq6no7va",
        };
        await axios.delete(`http://127.0.0.1:8081/api/stockopname/${item.id}`, {
          headers,
        });
        this.snackbar3 = true;
        await this.fetchData();

        this.closeDelete();
      } catch (error) {
        console.error("Error deleting item:", error);
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