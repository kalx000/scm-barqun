<template>
  <div>
    <Navbar />
    <LeftBar />
    <v-card-text>
      <v-data-table
        :headers="headers"
        :items="items"
        sort-by="idstock"
        class="elevation-5 pa-4"
        style="margin-top: 70px"
      >
        <template v-slot:top>
          <v-toolbar flat>
            <v-toolbar-title>Stock In</v-toolbar-title>
            <v-divider class="mx-4" inset vertical></v-divider>
            <v-spacer></v-spacer>
            <v-dialog v-model="dialogEdit" max-width="600px">
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
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="editedItem.idproduct"
                          label="Product Name"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="editedItem.idsupplier"
                          label="Supplier Name"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          @keypress="filter(event)"
                          v-model="editedItem.idstock"
                          label="Stock"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          @keypress="filter(event)"
                          v-model="editedItem.jumlah"
                          label="Incoming Amount"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          @keypress="filter(event)"
                          v-model="editedItem.tanggal"
                          label="Date Of Entry"
                        ></v-text-field>
                      </v-col>
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
            <v-dialog v-model="dialogDelete" max-width="550px">
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
        <!-- <v-dialog v-model="dialogDetail" max-width="550px">
        <v-card>
          <v-card-title> Details </v-card-title>
        </v-card>
      </v-dialog> -->
        <template v-slot:[`item.actions`]="{ item }">
          <div class="align-center">
            <v-menu transition="slide-y-transition" offset-y>
              <template v-slot:activator="{ on, attrs }">
                <v-btn icon color="secondary" v-bind="attrs" v-on="on">
                  <v-icon>fas fa-ellipsis-vertical</v-icon>
                </v-btn>
                <!-- <div class="text-center">
                <v-btn color="primary" @click="dialog = true">
                  Open Dialog
                </v-btn>

                <v-dialog v-model="dialog" width="auto">
                  <v-card>
                    <v-card-text>
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                      sed do eiusmod tempor incididunt ut labore et dolore magna
                      aliqua.
                    </v-card-text>
                    <v-card-actions>
                      <v-btn color="primary" block @click="dialog = false"
                        >Close Dialog</v-btn
                      >
                    </v-card-actions>
                  </v-card>
                </v-dialog>
              </div> -->
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
                <v-list-item @click="detailItem(item)">
                  <v-icon style="color: green" small class="mr-2"
                    >fa-reguler fa-eye</v-icon
                  >
                  <v-list-item-title>Details</v-list-item-title>
                </v-list-item>
              </v-list>
            </v-menu>
          </div>
        </template>
      </v-data-table>
    </v-card-text>
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
    dialogEdit: false,
    dialogDelete: false,
    formTitle: "",
    headers: [
      { text: "Supplier Name", align: "start", sortable: true, value: "supplier_id" },
      { text: "Product Name",  value: "product_id",},
      { text: "Stock", value: "stockout_id" },
      { text: "Incoming Amount", value: "jumlah_masuk" },
      { text: "Date Of Entry", value: "tanggal_masuk" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    items: [],
    editedIndex: -1,
    editedItem: {
      supplier_id: "",
      product_id: "",
      stockout_id: "",
      jumlah_masuk: "",
      tanggal_masuk: "",
    },
    defaultItem: {
      supplier_id: "",
      product_id: "",
      stockout_id: "",
      jumlah_masuk: "",
      tanggal_masuk: "",
    },
  }),

  methods: {
    editItem(item) {
      this.formTitle = "Edit Stock In";
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
      if (this.formTitle === "Add Stock In") {
        this.items.push(Object.assign({}, this.editedItem));
      } else {
        const index = this.items.indexOf(this.editedItem);
        this.items.splice(index, Object.assign({}, this.editedItem));
      }
      this.close();
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
    filter(event) {
      const charCode = event.which ? event.which : event.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        event.preventDefault();
      }
    },

    async save() {
      try {
        const headers = {
          Authorization: `Bearer 3|mZIUwp6JDcvKP4QB2H43dPJm22xCfY2UrtYRJ3k4`,
          "Content-Type": "application/json",
        };

        console.log("Form Title:", this.formTitle);
        console.log("Edited Item:", this.editedItem);

        if (this.formTitle === "Add Stock In") {
          console.log("Sending POST request...");
          await axios.post(
            "http://127.0.0.1:8081/api/stockin",
            this.editedItem,
            { headers }
          );
        } else {
          console.log("Sending PUT request...");
          await axios.put(
            `http://127.0.0.1:8081/api/stockin/${this.editedItem.id}`,
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
          Authorization: "Bearer 3|mZIUwp6JDcvKP4QB2H43dPJm22xCfY2UrtYRJ3k4",
        };
        await axios.delete(`http://127.0.0.1:8081/api/stockin/${item.id}`, {
          headers,
        });
        await this.fetchData();

        this.closeDelete();
      } catch (error) {
        console.error("Error deleting item:", error);
      }
    },

    async fetchData() {
      try {
        const headers = {
          Authorization: `Bearer 3|mZIUwp6JDcvKP4QB2H43dPJm22xCfY2UrtYRJ3k4`,
        };
        const response = await axios.get("http://127.0.0.1:8081/api/stockin", {
          headers,
        });
        this.items = response.data.data;
      } catch (error) {
        console.error("Error fetching data:", error);
      }
    },
  },
  mounted() {
    this.fetchData();
  },
};
</script>

<style>
</style>