<template>
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
                        color="secondary"
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
                              @keypress="filter(event)"
                                v-model="editedItem.idstock"
                                label="Stock"
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
                        <v-btn color="blue darken-1" text @click="close">
                          Cancel
                        </v-btn>
                        <v-btn color="blue darken-1" text @click="save">
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
                        <v-btn color="blue darken-1" text @click="closeDelete"
                          >Cancel</v-btn
                        >
                        <v-btn
                          color="blue darken-1"
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
</template>

<script>
export default {
     data: () => ({
    tab: null,
    dialog: false,
    dialogDelete: false,
    headers: [
      {
        text: "Product Name",
        align: "start",
        sortable: true,
        value: "idproduct",
      },
      { text: "Stock", value: "idstock" },
      { text: "Supplier Name", value: "idsupplier" },
      { text: "Incoming Amount", value: "jumlah" },
      { text: "Date Of Entry", value: "tanggal" },
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
          jumlah: "1",
          tanggal: "13-02-05",
        },
        {
          idproduct: "RJ45 Cable",
          idstock: 26000,
          idsupplier: "10 meter",
          jumlah: "1",
          tanggal: "13-02-06",
        },
        {
          idproduct: "RJ45 Cable",
          idstock: 26000,
          idsupplier: "10 meter",
          jumlah: "1",
          tanggal: "13-02-06",
        },
        {
          idproduct: "RJ45 Cable",
          idstock: 26000,
          idsupplier: "10 meter",
          jumlah: "1",
          tanggal: "13-02-06",
        },
        {
          idproduct: "RJ45 Cable",
          idstock: 26000,
          idsupplier: "10 meter",
          jumlah: "1",
          tanggal: "13-02-06",
        },
        {
          idproduct: "RJ45 Cable",
          idstock: 26000,
          idsupplier: "10 meter",
          jumlah: "1",
          tanggal: "13-02-06",
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
}
</script>

<style>

</style>