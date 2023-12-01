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
        class="elevation-2 pa-4"
        :loading="isLoading"
      loading-text="Loading... Please wait"
      >
        <template v-slot:top>
          <v-toolbar flat>
            <v-toolbar-title>Stock In</v-toolbar-title>
            <v-divider class="mx-4" inset vertical></v-divider>
            <v-spacer></v-spacer>
            <v-dialog v-model="dialog" max-width="650px">
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
                          prepend-icon= "mdi-plus-box-outline"
                        ></v-text-field>
                      </v-col>
                       <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="editedItem.idsupplier"
                          label="Supplier Name"
                          prepend-icon= "mdi-account-outline"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          @keypress="filter(event)"
                          v-model="editedItem.idstock"
                          label="Stock"
                          prepend-icon= "mdi-package-variant-closed"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          @keypress="filter(event)"
                          v-model="editedItem.jumlah"
                          label="Incoming Amount"
                          prepend-icon= "mdi-package-variant-closed-plus"
                        ></v-text-field>
                      </v-col>
                       <v-col cols="12" sm="6" md="4" >
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
                        v-model="tanggal_masuk"
                      label="Date Of Entry"
                      prepend-icon= "mdi-calendar-range"
                        readonly
                        v-bind="attrs"
                        v-on="on"
                      ></v-text-field>
                    </template>
                    <v-date-picker
                      v-model="tanggal_masuk"
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
    menu: false,
    headers: [
      {
        text: "Product Name",
        align: "start",
        sortable: true,
        value: "product_id",
      },
      { text: "Supplier Name", value: "supplier_id" },
      { text: "Stock", value: "inventory_id" },
      { text: "Incoming Amount", value: "jumlah_masuk" },
      { text: "Date Of Entry", value: "tanggal_masuk" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    isLoading: true,
    items: [],
    editedIndex: -1,
    editedItem: {
      supplier_id:"",
      product_id: "",
      inventory_id: "",
      supplier_id: "",
      jumlah_masuk: "",
      tanggal_masuk: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
    },
    defaultItem: {
      idsupplier:"",
      product_id: "",
      inventory_id: "",
      supplier_id: "",
      jumlah_masuk: "",
      tanggal_masuk: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
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
      // this.items = [
      //   {
      //     idproduct: "RJ45 Cable",
      //     idstock: 26000,
      //     idsupplier: "10 meter",
      //     jumlah: "1",
      //     tanggal: "13-02-05",
      //   },
      //   {
      //     idproduct: "RJ45 Cable",
      //     idstock: 26000,
      //     idsupplier: "10 meter",
      //     jumlah: "1",
      //     tanggal: "13-02-06",
      //   },
      //   {
      //     idproduct: "RJ45 Cable",
      //     idstock: 26000,
      //     idsupplier: "10 meter",
      //     jumlah: "1",
      //     tanggal: "13-02-06",
      //   },
      //   {
      //     idproduct: "RJ45 Cable",
      //     idstock: 26000,
      //     idsupplier: "10 meter",
      //     jumlah: "1",
      //     tanggal: "13-02-06",
      //   },
      //   {
      //     idproduct: "RJ45 Cable",
      //     idstock: 26000,
      //     idsupplier: "10 meter",
      //     jumlah: "1",
      //     tanggal: "13-02-06",
      //   },
      //   {
      //     idproduct: "RJ45 Cable",
      //     idstock: 26000,
      //     idsupplier: "10 meter",
      //     jumlah: "1",
      //     tanggal: "13-02-06",
      //   },
      // ];
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
      this.snackbar2 = true;
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
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
      this.snackbar1 = true;
    },
  },
  mounted() {
    axios
       .get("http://127.0.0.1:8081/api/stockin", {
    headers: {
      Authorization: "Bearer 1|9kDguz3xKqt0JZ7NaKGBa6QaJUHMIKtXUIXRySSk", // Add the token here
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