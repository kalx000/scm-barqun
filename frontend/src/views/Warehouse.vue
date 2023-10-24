<template>
  <div>
    <Navbar />
    <LeftBar />
    <v-card>
      <v-tabs v-model="tab" bg-color="primary" class="ml-8">
        <v-tab>Stock In</v-tab>
        <v-tab>Stock Out</v-tab>
        <v-tab>Stock Opname</v-tab>
      </v-tabs>

      <v-tabs-items v-model="tab">

        <v-tab-item>
         <StockIn />
        </v-tab-item>

        <v-tab-item>
          <StockOut />
        </v-tab-item>

        <v-tab-item>
          <StockOpName />
        </v-tab-item>

      </v-tabs-items>
    </v-card>
    <Footer />
  </div>
</template>

<script>
import LeftBar from "@/components/LeftBar.vue";
import Footer from "@/components/Footer.vue";
import Navbar from "@/components/NavBar.vue";
import StockIn from "@/components/warehouse/StockIn.vue"
import StockOut from "@/components/warehouse/StockOut.vue"
import StockOpName from "@/components/warehouse/StockOpName.vue"
export default {
  components: {
    LeftBar,
    Footer,
    Navbar,
    StockIn,
    StockOut,
    StockOpName,
  },
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
      { text: "Jumlah Stock", value: "idstock" },
      { text: "Supplier Name", value: "idsupplier" },
      { text: "Jumlah Masuk", value: "jumlah" },
      { text: "Tanggal Masuk", value: "tanggal" },
      { text: "actions", value: "actions", sortable: false },
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