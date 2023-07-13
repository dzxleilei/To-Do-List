const car = {
  // properties
  brand: "car",
  color: "red",
  maxSpeed: 200,
  chassisNumber: "f-1",
  //methods
  drive: () => {
    console.log("driving");
  },
  reverse: () => {
    console.log("reversing");
  },
};

console.log(car.brand);
console.log(car.color);
console.log(car.maxSpeed);
console.log(car.chassisNumber);
car.drive();
car.reverse();

// -------------------------------

function Car(brand, color, plate_number) {
  this.brand = brand;
  this.color = color;
  this.plate_number = plate_number;
}

Car.prototype.drive = function () {
  console.log(`${this.brand} ${this.color} is driving`);
};

Car.prototype.reverse = function () {
  console.log(`${this.brand} ${this.color} is driving`);
};

const car1 = new Car("Toyota", "Silver", "KB 1122 GA");
const car2 = new Car("BMW", "Red", "B 166 ER");

car1.drive();
car2.reverse();

// -------------------------------

// Latihan 1
// objek = barang
const barang = {
  // properti
  nama: "Lenovo Thinkpad x230",
  harga: "2300000",
  warna: "hitam",
  berat: "2kg",
};

// contoh solusi yang kurang baik
const barang1 = {
  name: "Lenovo Thinkpad x230",
  price: 100,
  // method
  detail: function () {
    return this.name + " " + this.price;
  },
};

const barang2 = {
  name: "Dell xps 13",
  price: 200,
  detail: function () {
    return this.name + " " + this.price;
  },
};

const barang3 = {
  name: "Lenovo Thinkpad X1 Carbon",
  price: 300,
  detail: function () {
    return this.name + " " + this.price;
  },
};

console.log(barang1.detail());
console.log(barang2.detail());
console.log(barang3.detail());

// function constructor
function Person() {} // function constructor
function person() {} // function declaration

function Barang(name, price) {
  this.name = name;
  this.price = price;
  this.detail = function () {
    return this.name + " " + this.price;
  };
}

// instance = objek baru dari constructor
const barang1 = new Barang("Lenovo Thinkpad x230", "2 juta");
const barang2 = new Barang("Dell xps 13", "10 juta");
const barang3 = new Barang("Lenovo Thinkpad X1 Carbon", "5 juta");

console.log(barang1.detail());
console.log(barang2.name, barang2.price);
console.log(barang3.name, barang3.price);

// classes
class Barang {
  constructor(name, price) {
    this.name = name;
    this.price = price;
  }
  detail() {
    return this.name + " " + this.price;
  }
}

const barang1 = new Barang("Lenovo Thinkpad x230", 100);
const barang2 = new Barang("Dell xps 13", 200);
const barang3 = new Barang("Lenovo Thinkpad X1 Carbon", 300);

console.log(barang1.detail()); // Lenovo Thinkpad x230
console.log(barang2.price); // 200
console.log(barang3.name); // Lenovo Thinkpad X1 Carbon

// access modifier atau visibility
function Barang(name, price, weight, color) {
  // public property
  this.name = name;
  this.price = price;

  // private property
  var weight = weight;
  var color = color;

  // public method
  this.detail = function () {
    return this.name + " " + this.price;
  };

  // private method
  function showWeightColor() {
    return weight + " " + color;
  }
}

// instance
const barang1 = new Barang("Lenovo", 100, 2, "Blue");

console.log(barang1); // Barang { name: 'Thinkpad', price: 200, detail: [Function] }
console.log(barang1.name); // Lenovo
console.log(barang1.weight); // undifined
console.log(barang1.detail()); // Lenovo 100
console.log(barang1.showWeightColor()); // TypeError: barang1.getWeightColor is not a function

// pilar oop
// encapsulation = membatasi akses langsung ke properti atau method dari sebuah objek
function Ongkir(berat) {
  var pajak = 500;
  var biaya = function () {
    return berat * 1000;
  };
  this.totalBiaya = function () {
    return this.biaya() + this.pajak;
  };
}

const laptop = new Ongkir(4);
laptop.pajak = 800; // tidak memengaruhi variabel pajak dalam constructor function karena private(var)
console.log(laptop.totalBiaya()); //4500

// inheritance = class mewariskan property dan methodnya ke class lain atau childnya
class People {
  constructor(name, age) {
    this.name = name;
    this.age = age;
  }
}
class Person extends People {
  // sub class dari People
  constructor(name, age, job) {
    super(name, age);
    this.job = job;
  }
}

const tanjiro = new Person("Kamado Tanjiro", 15, "Demon Slayer"); // instance objek baru

console.log(tanjiro.name); // Kamado Tanjiro
console.log(tanjiro.age); // 15
console.log(tanjiro.job); // Demon Slayer

// polymorphism = membuat variabel, fungsi, atau objek yang memiliki banyak bentuk
class People {
  constructor(name) {
    this.name = name;
  }
  greet() {
    return `Hello, good morning. My name is ${this.name}`;
  }
}

class Person extends People {
  constructor(name) {
    super(name);
  }
  greet() {
    return `Halo, selamat pagi. Nama saya adalah ${this.name}`;
  }
}

const seiya = new Person("Seiya");

console.log(seiya.greet()); // Halo, selamat pagi. Nama saya adalah Seiya

class People {
  constructor(name) {
    this.name = name;
  }
  greet() {
    return `Hello, good morning. My name is ${this.name}`;
  }
}

class Person extends People {
  constructor(name) {
    super(name);
  }
}

const seiya = new Person("Seiya");

console.log(seiya.greet()); // Hello, good morning. My name is Seiya

// jika greet() Person tidak ada maka dijalankan greet() People (parent)

// abstraction = menyembunyikan detail tertentu dari sebuah objek dan hanya menampilkan fungsionalitas atau fitur penting dari objek tersebut
function Ongkir(berat) {
  var berat = berat;
  var totalBiaya = function () {
    return berat * 1000;
  };
  this.tampilBiaya = function () {
    return totalBiaya();
  };
}

const laptop = new Ongkir(4);
console.log(laptop.totalBiaya()); //4000

// setter getter
class Product {
  constructor(name) {
    this.name = name; //maunya string string
  }
}
const thinkpad = new Product("Lenovo thinkap x230");
console.log(thinkpad.name); // Lenovo thinkpad x230

// setter = method mengubah value sebuah property
class Product {
  constructor() {
    this.name = null;
  }
  set setName(value) {
    // cek data sebelum ubah property name
    if (typeof value === "string") {
      this.name = value;
    } else {
      this.name = null;
    }
  }
}

const thinkpad = new Product();
const thinkpad.etName11 = "Thinkpad"; // ubah value property name jadi Thinkpad
const thinkpad.setName = 230; // value property name tetap null

// getter = method mengambil value sebuah property

class Product {
  constructor() {
    this.name = null;
  }
  set setName(value) {
    // cek data sebelum ubah property name
    if (typeof value === "string") {
      this.name = value;
    } else {
      this.name = null;
    }
  }
  get getName() {
    if (this.name === null) {
      return `value belum di set`;
    }
    return this.name;
  }
}
const thinkpad = new Product();
console.log(thinkpad.getName); // value belum di set
thinkpad.setName = "Thinkpad x230";
console.log(thinkpad.getName); // Thinkpad x230

// override = membuat method di dalam kelas child yang nama methodnya sama dengan method di class parentnya
class Product {
  constructor(name) {
    this.name = name;
  }
  getDetail() {
    return `product name is ${this.name}`;
  }
}

class Laptop extends Product {
  constructor(name, brand) {
    super(name);
    this.brand = brand;
  }
  getDetail() {
    return `product name is ${this.name} with brand ${this.brand}`;
  }
}

const thinkpad = new Laptop("Thinkpad", "IBM");
console.log(thinkpad.getDetail()); // product name is Thinkpad with brand IBM
