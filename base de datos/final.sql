CREATE database `venta` DEFAULT CHARACTER SET utf8mb4 ;
use venta;

create table nivel(
	id_nivel int auto_increment not null,
	tipo varchar(13) not null,
	primary key (id_nivel)
);

create table usuario(
	id_usuario int auto_increment not null,
	nombre varchar(100) not null,
	apellido varchar(100) not null,
	carnet varchar(15) not null,
	direccion varchar(250) not null,
	celular varchar(20) not null,	
	telefono varchar(20) not null,
	usuario varchar(50) not null,
	contraseña text(50) not null,
	id_nivel int not null,
	primary key(id_usuario),
	foreign key(id_nivel) references nivel(id_nivel)
);

create table cliente(
	id_cliente int auto_increment not null,
	nombre varchar(100) not null,
	apellido varchar(100) not null,
	carnet varchar(15) not null,
	direccion varchar(250) not null,
	celular varchar(20) not null,	
	telefono varchar(20) not null,
	primary key(id_cliente)
);

create table categorias(
	id_categoria int auto_increment not null,
	nombre_categoria varchar(100) not null,
	primary key(id_categoria)
);

create table producto(
	id_producto int auto_increment not null,
    id_categoria int not null,
	nombre_producto varchar(250) not null,
	tamaño varchar(250) not null,
	stock float not null,
	primary key(id_producto),
	foreign key(id_categoria) references categorias(id_categoria)
);

create table proveedor(
	idproveedor int auto_increment not null,
	nombreEmpresa varchar(100) not null,
	celular varchar(20) not null,
	telefono varchar(20) not null,
    direccion varchar(250) not null,
	primary key(idproveedor)
);

create table preventista(
	idPreventista int auto_increment not null,
	idProveedor int not null,
	nombre varchar(100) not null,
	apellido varchar(100) not null,
	celular varchar(20) not null,
	primary key(idPreventista),
	foreign key(idProveedor) references proveedor(idProveedor)
);

create table cantidad(
	id_cantidad int auto_increment not null,
	id_producto int not null,
    stockNuevo float not null,
	fecha_entrada date null,
	fecha_vencimiento date null,
	idPreventista int not null,
    precio_compra float not null, 
	precio_venta float not null,
	primary key(id_cantidad),
	foreign key(id_producto) references producto(id_producto),
	foreign key(idPreventista) references preventista(idPreventista)
);

create table venta(
	id_venta int not null,		
	id_cliente int not null,	
	id_producto int not null,	
	precio float not null,		
	cantidad float not null,	
	total float not null,		
	fechaCompra date not null, 	
	garantia float not null,	
	acuentaDinero float not null,
	acuantaCantidad float not null,
	totalfin float not null,
	debeCantidad float not null,
	direnoDado float not null,	
	cambioDado float not null,	
	foreign key (id_cliente) references cliente(id_cliente),
	foreign key (id_producto) references producto(id_producto)
);