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
            <v-toolbar-title>Inventory</v-toolbar-title>
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
                          v-model="editedItem.nama_gudang"
                          label="Warehouse Name"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="editedItem.lokasi_gudang"
                          label="Address"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          @keypress="filter(event)"
                          v-model="editedItem.kapasitas_stock"
                          label="Stock"
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
      <v-snackbar v-model="snackbar"> The Data Successfully Add </v-snackbar>
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
    snackbar: false,
    headers: [
      {
        text: "Warehouse Name",
        align: "start",
        sortable: true,
        value: "nama_gudang",
      },
      { text: "Address", value: "lokasi_gudang" },
      { text: "Stock", value: "kapasitas_stock" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    items: [],
    editedIndex: -1,
    editedItem: {
      nama_gudang: "",
      lokasi_gudang: "",
      kapasitas_stock: "",
    },
    defaultItem: {
      nama_gudang: "",
      lokasi_gudang: "",
      kapasitas_stock: "",
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

    detailItem(item) {
      this.dialogDetail = true;
    },

    editItem(item) {
      this.editedIndex = this.items.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogEdit = true;
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

    closeEdit() {
      this.dialogEdit = false;
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
      this.closeEdit();
      this.snackbar = true;
    },
  },
  mounted() {
    axios
      .get("http://127.0.0.1:8081/api/inventories")
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