// To parse this JSON data, do
//
//     final loginModulo = loginModuloFromJson(jsonString);

import 'dart:convert';

import 'package:app_tcc/main.dart';

TelaConsulta telaConsultaFromJson(String str) => TelaConsulta.fromJson(json.decode(str));

String telaConsultaToJson(TelaConsulta data) => json.encode(data.toJson());

class TelaConsulta {
  TelaConsulta({
    this.idProntuario,
    this.idConsulta,
    this.nomeUsuario,
    this.idAluno,
    this.nomeAluno,
    this.dataConsulta,
    this.tipoConsulta,
    this.codDiagnostico,
    this.textoDiagnostico,
    this.notaAvaliacao,
    this.textoAvaliacao,
    this.idAvaliador,
    this.historico
  });

  int idProntuario;
  String idConsulta;
  String nomeUsuario;
  int idAluno;
  String nomeAluno;
  String dataConsulta;
  String tipoConsulta;
  int codDiagnostico;
  String textoDiagnostico;
  int notaAvaliacao;
  String textoAvaliacao;
  int idAvaliador;
  String historico;

  factory TelaConsulta.fromJson(Map<String, dynamic> json) => TelaConsulta(
    idProntuario: json["idProntuario"],
    idConsulta: json["idConsulta"],
    nomeUsuario: json["nomeUsuario"],
    idAluno: json["idAluno"],
    nomeAluno: json["nomeAluno"],
    dataConsulta: json["dataConsulta"],
    tipoConsulta: json["tipoConsulta"],
    codDiagnostico: json["codDiagnostico"],
    textoDiagnostico:  json["textoDiagnostico"],
    notaAvaliacao: json["notaAvaliacao"],
    textoAvaliacao: json["textoAvaliacao"],
    idAvaliador: json["idAvaliador"],
    historico: json["historico"]
  );

  Map<String, dynamic> toJson() => {
    "idProntuario": idProntuario,
    "idConsulta": idConsulta,
    "nomeUsuario": nomeUsuario,
    "idAluno": idAluno,
    "nomeAluno": nomeAluno,
    "dataConsulta": dataConsulta,
    "tipoConsulta": tipoConsulta,
    "codDiagnostico": codDiagnostico,
    "textoDiagnostico": textoDiagnostico,
    "notaAvaliacao": notaAvaliacao,
    "textoAvaliacao": textoAvaliacao,
    "idAvaliador": idAvaliador,
    "historico": historico
  };
}