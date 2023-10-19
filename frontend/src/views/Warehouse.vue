<template>
  <div>
    <Navbar />
    <LeftBar />
    <v-card>
      <v-tabs v-model="tab" color="secondary" class="ml-8">
        <v-tab>Stock In</v-tab>
        <v-tab>Stock Out</v-tab>
        <v-tab>Stock Opname</v-tab>
      </v-tabs>

<v-tabs-items v-model="tab">


    <v-tab-item>
      <v-card-text>
            <v-data-table
              :headers="headers"
              :items="desserts"
              sort-by="idstock"
              class="elevation-5 pa-4"
            >
              <template v-slot:top>
                <v-toolbar flat>
                  <v-toolbar-title>Stock In</v-toolbar-title>
                  <v-divider class="mx-4" inset vertical></v-divider>
                  <v-spacer></v-spacer>
                  <v-dialog v-model="dialog" max-width="550px">
                    <template v-slot:activator="{ on, attrs }">
                      <v-btn
                        color="primary"
                        dark
                        class="mb-2"
                        v-bind="attrs"
                        v-on="on"
                      >
                      <v-icon>fa-solid fa-plus</v-icon>
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
                                v-model="editedItem.idstock"
                                label="Jumlah Stock"
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
                                v-model="editedItem.jumlah"
                                label="Jumlah Masuk"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                              <v-text-field
                                v-model="editedItem.tanggal"
                                label="Tanggal Masuk"
                              ></v-text-field>
                            </v-col>
                          </v-row>
                        </v-container>
                      </v-card-text>

                      <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="secondary" text @click="close">
                          Cancel
                        </v-btn>
                        <v-btn color="secondary" text @click="save">
                          Save
                        </v-btn>
                      </v-card-actions>
                    </v-card>
                  </v-dialog>
                  <v-dialog v-model="dialogDelete" max-width="500px">
                    <v-card>
                      <v-card-title class="text-h5"
                        >Are you sure you want to delete this
                        item?</v-card-title
                      >
                      <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="secondary" text @click="closeDelete"
                          >Cancel</v-btn
                        >
                        <v-btn
                          color="secondary"
                          text
                          @click="deleteItemConfirm"
                          >OK</v-btn
                        >
                        <v-spacer></v-spacer>
                      </v-card-actions>
                    </v-card>
                  </v-dialog>
                </v-toolbar>
              </template>
              <template v-slot:[`item.actions`]="{ item }">
                <v-icon small class="mr-2" @click="editItem(item)">
                  mdi-pencil
                </v-icon>
                <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon>
              </template>
              <template v-slot:no-data>
                <v-btn color="primary" @click="initialize"> Reset </v-btn>
              </template>
            </v-data-table>
            </v-card-text>
        </v-tab-item>


    <v-tab-item>
      <v-card-text>
            <v-data-table
              :headers="headers"
              :items="desserts"
              sort-by="idstock"
              class="elevation-5 pa-4"
            >
              <template v-slot:top>
                <v-toolbar flat>
                  <v-toolbar-title>Stock Out</v-toolbar-title>
                  <v-divider class="mx-4" inset vertical></v-divider>
                  <v-spacer></v-spacer>
                  <v-dialog v-model="dialog" max-width="550px">
                    <template v-slot:activator="{ on, attrs }">
                      <v-btn
                        color="primary"
                        dark
                        class="mb-2"
                        v-bind="attrs"
                        v-on="on"
                      >
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
                          <v-row>
                            <v-col cols="12" sm="6" md="4">
                              <v-text-field
                                v-model="editedItem.idproduct"
                                label="Product Name"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                              <v-text-field
                                v-model="editedItem.idstock"
                                label="Jumlah Stock"
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
                                v-model="editedItem.jumlah"
                                label="Jumlah Masuk"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                              <v-text-field
                                v-model="editedItem.tanggal"
                                label="Tanggal Masuk"
                              ></v-text-field>
                            </v-col>
                          </v-row>
                        </v-container>
                      </v-card-text>

                      <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="secondary" text @click="close">
                          Cancel
                        </v-btn>
                        <v-btn color="secondary" text @click="save">
                          Save
                        </v-btn>
                      </v-card-actions>
                    </v-card>
                  </v-dialog>
                  <v-dialog v-model="dialogDelete" max-width="500px">
                    <v-card>
                      <v-card-title class="text-h5"
                        >Are you sure you want to delete this
                        item?</v-card-title
                      >
                      <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="secondary" text @click="closeDelete"
                          >Cancel</v-btn
                        >
                        <v-btn
                          color="secondary"
                          text
                          @click="deleteItemConfirm"
                          >OK</v-btn
                        >
                        <v-spacer></v-spacer>
                      </v-card-actions>
                    </v-card>
                  </v-dialog>
                </v-toolbar>
              </template>
              <template v-slot:[`item.actions`]="{ item }">
                <v-icon small class="mr-2" @click="editItem(item)">
                  mdi-pencil
                </v-icon>
                <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon>
              </template>
              <template v-slot:no-data>
                <v-btn color="primary" @click="initialize"> Reset </v-btn>
              </template>
            </v-data-table>
            </v-card-text>
        </v-tab-item>


    <v-tab-item>
      <v-card-text>
            <v-data-table
              :headers="headers"
              :items="desserts"
              sort-by="idstock"
              class="elevation-5 pa-4"
            >
              <template v-slot:top>
                <v-toolbar flat>
                  <v-toolbar-title>Stock Opname</v-toolbar-title>
                  <v-divider class="mx-4" inset vertical></v-divider>
                  <v-spacer></v-spacer>
                  <v-dialog v-model="dialog" max-width="550px">
                    <template v-slot:activator="{ on, attrs }">
                      <v-btn
                        color="primary"
                        dark
                        class="mb-2"
                        v-bind="attrs"
                        v-on="on"
                      >
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
                          <v-row>
                            <v-col cols="12" sm="6" md="4">
                              <v-text-field
                                v-model="editedItem.idproduct"
                                label="Product Name"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                              <v-text-field
                                v-model="editedItem.idstock"
                                label="Jumlah Stock"
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
                                v-model="editedItem.jumlah"
                                label="Jumlah Masuk"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                              <v-text-field
                                v-model="editedItem.tanggal"
                                label="Tanggal Masuk"
                              ></v-text-field>
                            </v-col>
                          </v-row>
                        </v-container>
                      </v-card-text>

                      <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="secondary" text @click="close">
                          Cancel
                        </v-btn>
                        <v-btn color="secondary" text @click="save">
                          Save
                        </v-btn>
                      </v-card-actions>
                    </v-card>
                  </v-dialog>
                  <v-dialog v-model="dialogDelete" max-width="500px">
                    <v-card>
                      <v-card-title class="text-h5"
                        >Are you sure you want to delete this
                        item?</v-card-title
                      >
                      <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="secondary" text @click="closeDelete"
                          >Cancel</v-btn
                        >
                        <v-btn
                          color="secondary"
                          text
                          @click="deleteItemConfirm"
                          >OK</v-btn
                        >
                        <v-spacer></v-spacer>
                      </v-card-actions>
                    </v-card>
                  </v-dialog>
                </v-toolbar>
              </template>
              <template v-slot:[`item.actions`]="{ item }">
                <v-icon small class="mr-2" @click="editItem(item)">
                  mdi-pencil
                </v-icon>
                <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon>
              </template>
              <template v-slot:no-data>
                <v-btn color="primary" @click="initialize"> Reset </v-btn>
              </template>
            </v-data-table>
            </v-card-text>
        </v-tab-item>


</v-tabs-items>
    </v-card>
    <Footer />
  </div>
</template>

<script>
import LeftBar from "@/components/LeftBar.vue";
import Footer from "@/components/Footer.vue";
import Navbar from "@/components/NavBar.vue"
export default {
  components: {
    LeftBar,
    Footer,
    Navbar
  },
  data: () => ({
    tab:null,
    dialog: false,
    dialogDelete: false,
    headers: [
      {
        text: "Product Name",
        align: "start",
        sortable: true,
        value: "idproduct",
      },
      { text: "Jumlah Stock", value: "idstock" },
      { text: "Supplier Name", value: "idsupplier" },
      { text: "Jumlah Masuk", value: "jumlah" },
      { text: "Tanggal Masuk", value: "tanggal" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    desserts: [],
    editedIndex: -1,
    editedItem: {
      idproduct: "",
      idstock: "",
      idsupplier: "",
      jumlah: "",
      tanggal: "",
    },
    defaultItem: {
      idproduct: "",
      idstock: "",
      idsupplier: "",
      jumlah: "",
      tanggal: "",
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
          idproduct: "RJ45 Cable",
          idstock: 26000,
          idsupplier: "10 meter",
          jumlah: "Gudang",
          tanggal: "130205",
        },
        {
          idproduct: "RJ45 Cable",
          idstock: 26000,
          idsupplier: "10 meter",
          jumlah: "Gudang",
          tanggal: "130206",
        },
        {
          idproduct: "RJ45 Cable",
          idstock: 26000,
          idsupplier: "10 meter",
          jumlah: "Gudang",
          tanggal: "130206",
        },
        {
          idproduct: "RJ45 Cable",
          idstock: 26000,
          idsupplier: "10 meter",
          jumlah: "Gudang",
          tanggal: "130206",
        },
        {
          idproduct: "RJ45 Cable",
          idstock: 26000,
          idsupplier: "10 meter",
          jumlah: "Gudang",
          tanggal: "130206",
        },
        {
          idproduct: "RJ45 Cable",
          idstock: 26000,
          idsupplier: "10 meter",
          jumlah: "Gudang",
          tanggal: "130206",
        },
      ];
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