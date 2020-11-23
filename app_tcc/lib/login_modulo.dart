// To parse this JSON data, do
//
//     final loginModulo = loginModuloFromJson(jsonString);

import 'dart:convert';

LoginModulo loginModuloFromJson(String str) => LoginModulo.fromJson(json.decode(str));

String loginModuloToJson(LoginModulo data) => json.encode(data.toJson());

class LoginModulo {
  LoginModulo({
    this.usuario,
    this.senha,
    this.token,
    this.id,
  });

  String usuario;
  String senha;
  String token;
  String id;

  factory LoginModulo.fromJson(Map<String, dynamic> json) => LoginModulo(
    usuario: json["usuario"],
    senha: json["senha"],
    token: json["token"],
    id: json['id'],
  );

  Map<String, dynamic> toJson() => {
    "usuario": usuario,
    "senha": senha,
    "token": token,
    "id":id,
  };
}
