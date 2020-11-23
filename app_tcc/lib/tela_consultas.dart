// To parse this JSON data, do
//
//     final loginModulo = loginModuloFromJson(jsonString);

import 'dart:convert';

import 'package:app_tcc/main.dart';

TelaTodasConsultas telaTodasConsultasFromJson(String str) => TelaTodasConsultas.fromJson(json.decode(str));

String telaTodasConsultasToJson(TelaTodasConsultas data) => json.encode(data.toJson());

class TelaTodasConsultas {
  TelaTodasConsultas({
    this.idConsulta,
    this.idUsuario,
    this.nomeUsuario,
    this.idAluno,
    this.nomeAluno,
    this.dataConsulta,
    this.tipoConsulta,
    this.idCurso,
    this.flagAnamnese,
    this.historico,
  });

  String idConsulta;
  String idUsuario;
  String nomeUsuario;
  int idAluno;
  String nomeAluno;
  String dataConsulta;
  String tipoConsulta;
  String idCurso;
  int flagAnamnese;
  String historico;

  factory TelaTodasConsultas.fromJson(Map<String, dynamic> json) => TelaTodasConsultas(
    idConsulta: json["idConsulta"],
    idUsuario: json["idUsuario"],
    nomeUsuario: json["nomeUsuario"],
    idAluno: json["idAluno"],
    nomeAluno: json["nomeAluno"],
    dataConsulta: json["dataConsulta"],
    tipoConsulta: json["tipoConsulta"],
    idCurso: json["idCurso"],
    flagAnamnese: json["flagAnamnese"],
    historico: json["historico"],
  );

  Map<String, dynamic> toJson() => {
    "idConsulta": idConsulta,
    "idUsuario" : idUsuario,
    "nomeUsuario": nomeUsuario,
    "nomeAluno": nomeAluno,
    "dataConsulta": dataConsulta,
    "tipoConsulta": tipoConsulta,
    "idCurso": idCurso,
    "flagAnamnese": flagAnamnese,
    "historico": historico
  };
}