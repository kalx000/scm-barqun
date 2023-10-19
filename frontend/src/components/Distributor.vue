<template>
  <v-app>
    <v-data-table
      :headers="headers"
      :items="desserts"
      sort-by="price"
      class="elevation-5 pa-4"
    >
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>Order</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>
          <v-dialog v-model="dialog" max-width="500px">
            <template v-slot:activator="{ on, attrs }">
              <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
                New Item
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
                        v-model="editedItem.idorder"
                        label="ID Order"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.idcustomer"
                        label="ID Customer"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.jumlah"
                        label="Jumlah Barang"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.idproduct"
                        label="ID Product"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.tanggal"
                        label="Tanggal Pemesanan"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.status"
                        label="Status Pemesanan"
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
        <v-icon small class="mr-2" @click="editItem(item)"> mdi-pencil </v-icon>
        <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon>
      </template>
      <template v-slot:no-data>
        <v-btn color="primary" @click="initialize"> Reset </v-btn>
      </template>
    </v-data-table>
  </v-app>
</template>
<script>
export default {
  data: () => ({
    tab: null,
    dialog: false,
    dialogDelete: false,
    headers: [
      {
        text: "ID Order",
        align: "start",
        sortable: true,
        value: "idorder",
      },
      { text: "ID Customer", value: "idcustomer" },
      { text: "ID Product", value: "idproduct" },
      { text: "Jumlah Barang", value: "jumlah" },
      { text: "No tanggal", value: "tanggal" },
      { text: "Status", value: "status" },
      { text: "actions", value: "actions", sortable: false },
    ],
    desserts: [],
    editedIndex: -1,
    editedItem: {
      idorder: "",
      idcustomer: "",
      jumlah: "",
      idproduct: "",
      tanggal: "",
      status: "",
    },
    defaultItem: {
      idorder: "",
      idcustomer: "",
      jumlah: "",
      idproduct: "",
      tanggal: "",
      status: "",
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
          idorder: "12345",
          idcustomer: '54321',
          jumlah: '10',
          idproduct: "09876",
          tanggal: "02/10/2023",
          status: "-",
        },
        {
          idorder: "12345",
          idcustomer: '54321',
          jumlah: '10',
          idproduct: "09876",
          tanggal: "02/10/2023",
          status: "-",
        },
        {
          idorder: "12345",
          idcustomer: '54321',
          jumlah: '10',
          idproduct: "09876",
          tanggal: "02/10/2023",
          status: "-",
        },
        {
          idorder: "12345",
          idcustomer: '54321',
          jumlah: '10',
          idproduct: "09876",
          tanggal: "02/10/2023",
          status: "-",
        },
        {
          idorder: "12345",
          idcustomer: '54321',
          jumlah: '10',
          idproduct: "09876",
          tanggal: "02/10/2023",
          status: "-",
        },
        {
          idorder: "12345",
          idcustomer: '54321',
          jumlah: '10',
          idproduct: "09876",
          tanggal: "02/10/2023",
          status: "-",
        },
        {
          idorder: "12345",
          idcustomer: '54321',
          jumlah: '10',
          idproduct: "09876",
          tanggal: "02/10/2023",
          status: "-",
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
