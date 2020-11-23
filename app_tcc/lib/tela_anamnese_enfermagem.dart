// To parse this JSON data, do
//
//     final loginModulo = loginModuloFromJson(jsonString);

import 'dart:convert';

import 'package:app_tcc/main.dart';

TelaDeAnamneseEnfermagem telaDeAnamneseEnfermagemFromJson(String str) => TelaDeAnamneseEnfermagem.fromJson(json.decode(str));

String telaDeAnamneseEnfermagemToJson(TelaDeAnamneseEnfermagem data) => json.encode(data.toJson());

class TelaDeAnamneseEnfermagem {
  TelaDeAnamneseEnfermagem({
    this.id,
    this.idUsuario,
    this.nomeUsuario,
    this.idConsulta,
    this.queixaPrincipal,
    this.inicio,
    this.doenca,
    this.descDoenca,
    this.alergia,
    this.descAlergia,
    this.medicamento,
    this.descMedicamento,
    this.fumo,
    this.freqFumo,
    this.bebidas,
    this.freqBebidas,
    this.drogas,
    this.freqDrogas,
    this.exercicios,
    this.freqExercicios,
    this.recreacao,
    this.descRecreacao,
    this.animais,
    this.descAnimais,
    this.postos,
    this.doencaFamilia,
    this.tratamentoFamilia
  });

  String id;
  String idUsuario;
  String nomeUsuario;
  String idConsulta;
  String queixaPrincipal;
  String inicio;
  String doenca;
  String descDoenca;
  String alergia;
  String descAlergia;
  String medicamento;
  String descMedicamento;
  String fumo;
  String freqFumo;
  String bebidas;
  String freqBebidas;
  String drogas;
  String freqDrogas;
  String exercicios;
  String freqExercicios;
  String recreacao;
  String descRecreacao;
  String animais;
  String descAnimais;
  String postos;
  String doencaFamilia;
  String tratamentoFamilia;

  factory TelaDeAnamneseEnfermagem.fromJson(Map<String, dynamic> json) => TelaDeAnamneseEnfermagem(
    id: json["id"],
    idUsuario: json["idUsuario"],
    nomeUsuario: json["nomeUsuario"],
    idConsulta: json["idConsulta"],
    queixaPrincipal: json["queixaPrincipal"],
    inicio: json["inicio"],
    doenca: json["doenca"],
    descDoenca: json["descDoenca"],
    alergia: json["alergia"],
    descAlergia: json["descAlergia"],
    medicamento: json["medicamento"],
    descMedicamento: json["descMedicamento"],
    fumo: json["fumo"],
    freqFumo: json["freqFumo"],
    bebidas: json["bebidas"],
    freqBebidas: json["freqBebidas"],
    drogas: json["drogas"],
    freqDrogas: json["freqDrogas"],
    exercicios: json["exercicios"],
    freqExercicios: json["freqExercicios"],
    recreacao: json["recreacao"],
    descRecreacao: json["descRecreacao"],
    animais: json["animais"],
    descAnimais: json["descAnimais"],
    postos: json["postos"],
    doencaFamilia: json["doencaFamilia"],
    tratamentoFamilia: json["tratamentoFamilia"]
  );

  Map<String, dynamic> toJson() => {
    "id": id,
    "idUsuario": idUsuario,
    "nomeUsuario": nomeUsuario,
    "idConsulta": idConsulta,
    "queixaPrincipal": queixaPrincipal,
    "inicio": inicio,
    "doenca": doenca,
    "descDoenca": descDoenca,
    "alergia": alergia,
    "descAlergia": descAlergia,
    "medicamento": medicamento,
    "descMedicamento": descMedicamento,
    "fumo": fumo,
    "freqFumo":freqFumo,
    "bebidas":bebidas,
    "freqBebidas":freqBebidas,
    "drogas": drogas,
    "freqDrogas": freqDrogas,
    "exercicios": exercicios,
    "freqExercicios": freqExercicios,
    "recreacao" : recreacao,
    "descRecreacao": descRecreacao,
    "animais": animais,
    "descAnimais": descAnimais,
    "postos": postos,
    "doencaFamilia":doencaFamilia,
    "tratamentoFamilia":tratamentoFamilia
  };
}