import 'dart:async';
import 'dart:convert';
import 'dart:ffi';
import 'dart:io';
//import 'dart:js_util';
import 'dart:math';

import 'package:app_tcc/tela_anamnese_enfermagem.dart';
import 'package:app_tcc/tela_consultas.dart';
import 'package:flutter/animation.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'login_modulo.dart';
import 'tela_consultas.dart';
import 'tela_consulta.dart';
import 'tela_anamnese_enfermagem.dart';
import 'tela_anamnese_fisioterapia.dart';



LoginModulo _login;

void main() async {
  runApp(
    MaterialApp(
      debugShowCheckedModeBanner: false,
      home: TelaLogin(),
    ),
  );
}


/*---------------------- FUNÇÕES TELA LOGIN -----------------------------*/
Future<LoginModulo> criarUsuario(String usuario, String senha) async{
  String apiUrl = "http://192.168.56.1/clinicaTcc/post.php";
  final response = await http.post(apiUrl, body:{
    "usuario":usuario,
    "senha" : senha,
  });
  if(response.statusCode == 201){
    final String responseString = response.body;
    return loginModuloFromJson(responseString);
  }
  else{
    return null;
  }
}

class TelaLogin extends StatefulWidget{
  _telaLoginState createState() => _telaLoginState();
}

class TelaConsultas extends StatefulWidget{
  _telaConsultasState createState() => _telaConsultasState();
}

class TelaDeConsulta extends StatefulWidget{
  _telaConsultaState createState() => _telaConsultaState();
}

class TelaAnamneseEnfermagem extends StatefulWidget{
  _telaAnamneseEnfermagemState createState() => _telaAnamneseEnfermagemState();
}

class TelaAnamneseFisio extends StatefulWidget{
  _telaAnamneseFisioState createState() => _telaAnamneseFisioState();
}


class _telaLoginState extends State<TelaLogin>{

  final TextEditingController usuarioController = TextEditingController();

  final TextEditingController senhaController = TextEditingController();

  @override
  Widget build(BuildContext context){
    return Scaffold(
      backgroundColor:  Colors.white,
      body: SingleChildScrollView(
          child: Column(
              children: <Widget>[
                Container(
                  height: 150,
                  decoration: BoxDecoration(
                      image: DecorationImage(
                          image: AssetImage('assets/images/header.png'),
                          fit: BoxFit.none
                      )
                  ),
                ),
                Container(
                    child: Text("Acesso às Clínicas", style: TextStyle(color: Colors.black, fontSize: 25.0))
                ),

                Padding(
                  padding: EdgeInsets.all(20.0),
                  child: TextFormField(
                    controller:  usuarioController,
                    keyboardType: TextInputType.text,
                    style: TextStyle(color:Colors.black),
                    decoration: InputDecoration(
                      labelText: "Código do Usuário",
                      labelStyle: TextStyle(fontSize: 20.0, color: Colors.black),
                      hintText: "Informe seu RA",
                    ),
                  ),
                ),
                Padding(
                  padding: EdgeInsets.all(20.0),
                  child: TextFormField(
                    controller: senhaController,
                    obscureText: true,
                    keyboardType: TextInputType.text,
                    style: TextStyle(color:Colors.black),
                    decoration: InputDecoration(
                      labelText: "Senha",
                      labelStyle: TextStyle(fontSize: 20.0, color: Colors.black),
                      hintText: "Informe sua Senha",
                    ),
                  ),
                ),
                Padding(
                  padding: EdgeInsets.all(20.0),
                  child: SizedBox(
                    height: 32,
                  ),
                ),
                RaisedButton(
                  onPressed: () async{
                    final String usuario = usuarioController.text;
                    final String senha = senhaController.text;
                    final LoginModulo login = await criarUsuario(usuario, senha);
                    setState((){
                      _login = login;
                    });
                    _login == null ? Text("Usuário Inválido"): Navigator.of(context).push(MaterialPageRoute(builder: (context) => TelaConsultas(), settings: RouteSettings(arguments: _login)));
                    // Validate returns true if the form is valid, otherwise false.
                    /*if (_formKey.currentState.validate()) {
                // If the form is valid, display a snackbar. In the real world,
                // you'd often call a server or save the information in a database.

                Scaffold
                    .of(context)
                    .showSnackBar(SnackBar(content: Text('Processing Data')));
              }*/
                  },
                  child: Text('Abrir'),
                )
              ]
          )
      ),
    );
  }
}
/*--------------------------------------------------------------------*/
/*---------------------- FUNÇÕES TELA CONSULTAS ----------------------*/
Future<List<TelaTodasConsultas>> gerarConsultas(String idAluno) async{
  String apiUrl = "http://192.168.56.1/clinicaTcc/post.php";
  final response = await http.post(apiUrl, body:{
    "idAluno": idAluno,
  });
  if(response.statusCode == 201){
    final  responseString = response.body;
    List<String> consultas = responseString.split("{");
    List<TelaTodasConsultas> todasConsulta;
    for(int i = 1; i < consultas.length; i++){
      String consultaJson = '{'+consultas[i];
      TelaTodasConsultas consulta = (telaTodasConsultasFromJson(consultaJson));
      if(i == 1) {
        todasConsulta = [consulta];
      }else{
        todasConsulta.add(consulta);
      }
    }
    return todasConsulta;
  }else{
    return null;
  }
}


TableRow escreveTexto(TelaTodasConsultas todasConsultas,BuildContext context) {
  TableRow linha = TableRow(
      children: [
        TableCell(
          child: Text(todasConsultas.dataConsulta),
        ),
        TableCell(
          child: Text(todasConsultas.nomeUsuario),
        ),
        TableCell(
          child: Text(todasConsultas.tipoConsulta),
        ),
        TableCell(
          child: RaisedButton(
            onPressed:(){
              todasConsultas.nomeUsuario == null ? Text("Erro de dados"): Navigator.of(context).push(MaterialPageRoute(builder: (context) => TelaDeConsulta(), settings: RouteSettings(arguments: [todasConsultas.idConsulta,todasConsultas.idUsuario,todasConsultas.nomeUsuario,todasConsultas.idCurso,todasConsultas.flagAnamnese.toString(),todasConsultas.historico])));
            },
            child: Text("Abrir"),
          ),
        )
      ]
  );
  return linha;
}


class _telaConsultasState extends State<TelaConsultas>{
  TelaTodasConsultas _consultas;
  List<TelaTodasConsultas> _todasConsultas;
  int _qtdConsulta = 0;
  Widget build(BuildContext context) {
    final LoginModulo usuario = ModalRoute.of(context).settings.arguments;
    return Scaffold(
      backgroundColor: Colors.white,
      body:
      Container(
        child: Column(
          children: <Widget>[
            Container(
              height: 150,
              decoration: BoxDecoration(
                  image: DecorationImage(
                      image: AssetImage('assets/images/header.png'),
                      fit: BoxFit.none
                  )
              ),
            ),
            Container(
                child: Column(
                  children: <Widget>[
                    Text("Consultas", style: TextStyle(fontSize: 25.0)),
                    Divider(
                      color: Colors.black,
                      indent: 20,
                      endIndent: 20,
                    )
                  ],
                )
            ),
            Container(
              child: FutureBuilder <List<TelaTodasConsultas>>(
                future: gerarConsultas(usuario.id.toString()),
                builder: (BuildContext context, AsyncSnapshot<List<TelaTodasConsultas>> text){
                  if(text.hasData){
                    _todasConsultas = text.data;
                    _qtdConsulta = _todasConsultas.length;
                    return Text("");
                  }else{
                    return Text("Não foram encontradas consultas");
                  }
                },
              ),
            ),
            Container(
              child: Padding(
                  padding: EdgeInsets.fromLTRB(25.0, 0.0, 25.0, 0.0),
                  child: Column(
                    children: <Widget>[
                      Table(
                        border: TableBorder(
                            horizontalInside: BorderSide(
                              color: Colors.black,
                              style: BorderStyle.solid,
                              width: 1.0,
                            )
                        ),
                        children: [
                          TableRow(
                            children:[
                              TableCell(
                                child: Text("Horário",style: TextStyle(fontWeight: FontWeight.bold,fontSize: 20.0)),
                              ),
                              TableCell(
                                child: Text("Paciente",style: TextStyle(fontWeight: FontWeight.bold,fontSize: 20.0)),
                              ),
                              TableCell(
                                child: Text("Tipo",style: TextStyle(fontWeight: FontWeight.bold,fontSize: 20.0)),
                              ),
                              TableCell(
                                child: Text("Ações",style: TextStyle(fontWeight: FontWeight.bold,fontSize: 20.0)),
                              )
                            ],
                          ),

                          if(_qtdConsulta != 0) for(int i = 0; i < _qtdConsulta; i++) escreveTexto(_todasConsultas[i], context) else for(int i = 0; i < _qtdConsulta; i++) escreveTexto(_todasConsultas[i], context)

                        ],
                      )
                    ],
                  )
              ),
            ),
          ],
        ),
      ),
    );
  }
}

/*--------------------------------------------------------------------*/
/*---------------------- FUNÇÕES TELA CONSULTA ----------------------*/
class _telaConsultaState extends State<TelaDeConsulta> {

  final TextEditingController codDiagnostico = TextEditingController();

  final TextEditingController textDiagnostico = TextEditingController();

  Future<bool> enviaDiagnostico(String diagnostico, String textoDiagnostico, String idConsulta) async{
    String apiUrl = "http://192.168.56.1/clinicaTcc/post.php";
    final response = await http.post(apiUrl, body:{
      "diagnostico": diagnostico,
      "textoDiagnostico": textoDiagnostico,
      "idConsulta": idConsulta,
      "acao": "envia_diagnostico",
    });
    if(response.statusCode == 201){
      print("Enviado com sucesso!");
    }
  }
  Widget build(BuildContext context) {
    final List<String> consulta = ModalRoute.of(context).settings.arguments;
    return Scaffold(
        backgroundColor: Colors.white,
        body: SingleChildScrollView(
          child: Column(
              children: <Widget>[
                Container(
                  height: 150,
                  decoration: BoxDecoration(
                      image: DecorationImage(
                          image: AssetImage('assets/images/header.png'),
                          fit: BoxFit.none
                      )
                  ),
                ),
                Container(
                  child: Column(
                    children: [
                      Text("CONSULTA", style: TextStyle(fontSize: 25.0))
                    ],
                  ),
                ),
                Container(
                    child: Divider(
                      color: Colors.black,
                      height: 30,
                      thickness: 2,
                      indent: 20,
                      endIndent: 20,
                    )
                ),
                Container(
                  child: Row(
                    children: [
                      Padding(
                        padding: EdgeInsets.fromLTRB(25.0, 35.0, 0.0, 0.0),
                      ),
                      Text("Nome do Paciente:", style: TextStyle(fontSize: 20.0,fontWeight: FontWeight.bold)),
                    ],
                  ),
                ),
                Container(
                  child: Row(
                    children: [
                      Padding(
                        padding: EdgeInsets.fromLTRB(25.0, 35.0, 0.0, 0.0),
                      ),
                      Text(consulta[2], style: TextStyle(fontSize: 18.0))
                    ],
                  ),
                ),
                Container(
                    child: Divider(
                      color: Colors.grey,
                      height: 0,
                      thickness: 0.5,
                      indent: 20,
                      endIndent: 20,
                    )
                ),
                Container(
                  child: Column(
                    children: [
                      Padding(
                        padding: EdgeInsets.fromLTRB(0.0, 5.0, 0.0, 10.0),
                      ),
                      Text("Ficha de Pré-Avaliação",style: TextStyle(fontSize: 20.0)),
                      Padding(
                        padding: EdgeInsets.fromLTRB(0.0, 10.0, 0.0, 10.0),
                      ),
                      RaisedButton(
                          child: Text("Vizualizar Ficha",style: TextStyle(fontSize: 15.0)),
                          onPressed:() {
                            print(consulta);
                            if (consulta[4] == "1") {
                              if (consulta[3] == "2") {
                                consulta[1] == null
                                    ? Text("Erro de dados")
                                    : Navigator.of(context).push(
                                    MaterialPageRoute(builder: (context) =>
                                        TelaAnamneseEnfermagem(),
                                        settings: RouteSettings(
                                            arguments: consulta[1])));
                              } else if (consulta[3] == "1") {
                                consulta[1] == null
                                    ? Text("Erro de dados")
                                    : Navigator.of(context).push(
                                    MaterialPageRoute(builder: (context) =>
                                        TelaAnamneseFisio(),
                                        settings: RouteSettings(
                                            arguments: consulta[1])));
                              }
                            }
                          }
                      ),
                    ],
                  ),
                ),
                Container(
                    child: Divider(
                      color: Colors.black,
                      height: 10,
                      thickness: 1,
                      indent: 20,
                      endIndent: 20,
                    )
                ),
                Container(
                    child: Column(
                        children: [
                          Padding(
                            padding: EdgeInsets.fromLTRB(20.0, 5.0, 20.0, 10.0),
                            child: TextFormField(
                                controller:  codDiagnostico,
                                keyboardType: TextInputType.text,
                                style: TextStyle(color:Colors.black),
                                decoration: InputDecoration(
                                  labelText: "Diagnóstico",
                                  labelStyle: TextStyle(fontSize: 20.0, color: Colors.black),
                                  hintText: "Informe o diagnóstico da consulta",
                                )
                            ),
                          ),
                          Container(
                              child: Column(
                                  children: [
                                    Padding(
                                      padding: EdgeInsets.fromLTRB(20.0, 5.0, 20.0, 10.0),
                                      child: TextField(
                                        controller:  textDiagnostico,
                                        maxLines: 4,
                                        decoration: InputDecoration.collapsed(hintText: "Comentários"),
                                      ),
                                    ),
                                  ] //children
                              )
                          ),
                          Container(
                            child: Column(
                              children: [
                                Padding(
                                  padding: EdgeInsets.fromLTRB(0.0, 10.0, 0.0, 10.0),
                                ),
                                RaisedButton(
                                  onPressed: () {
                                    showDialog(
                                        context: context,
                                        builder: (BuildContext dialogContext) {
                                          return AlertDialog(
                                            title: Text("Confirmar envio"),
                                            content: Text("Tem certeza que deseja enviar esse diagnóstico?"),
                                            actions: [
                                              FlatButton(
                                                child: Text("OK"),
                                                onPressed: () {
                                                  enviaDiagnostico(codDiagnostico.text, textDiagnostico.text,consulta[0]);
                                                  Navigator.pop(dialogContext);
                                                  Navigator.of(context).push(MaterialPageRoute(builder: (context) => TelaConsultas(), settings: RouteSettings(arguments: _login)));
                                                },
                                              ),
                                              FlatButton(
                                                child: Text("Cancelar"),
                                                onPressed: () { Navigator.pop(dialogContext); },
                                              ),
                                            ],
                                          );
                                        }
                                    );
                                  },
                                  child: Text("Enviar Diagnóstico",style: TextStyle(fontSize: 15.0)),
                                ),
                              ],
                            ),
                          ),
                          Container(
                            child: RaisedButton(
                                child: Text("Voltar"),
                                onPressed: () {
                                  Navigator.pop(context);
                                }
                            ),
                          ),
                          Container(
                              child: Divider(
                                color: Colors.grey,
                                height: 5,
                                thickness: 0.5,
                                indent: 20,
                                endIndent: 20,
                              )
                          ),
                          Container(
                            child: Column(
                              children: [
                                Padding(
                                  padding: EdgeInsets.fromLTRB(0.0, 5.0, 0.0, 10.0),
                                ),
                                Text("Histórico do Paciente",style: TextStyle(fontSize: 20.0)),
                              ],
                            ),
                          ),
                          Container(
                            child: Column(
                              children: [
                                Padding(
                                  padding: EdgeInsets.fromLTRB(20.0, 5.0, 20.0, 10.0),
                                ),
                                Text(consulta[5])
                              ],
                            ),
                          )
                        ]
                    )
                )
              ]
          ),
        )
    );
  }
}
/*-------------------------------------------------------------------*/
/*----------------- FUNÇÕES TELA ANAMNESE ENFERMAGEM ----------------*/
Future<Container> gerarAnamneseEnfermagem(String idUsuario) async {
  String apiUrl = "http://192.168.56.1/clinicaTcc/post.php";
  final response = await http.post(apiUrl, body:{
    "acao": "ver_anamnese_enfermagem",
    "idUsuario": idUsuario,
  });
  if(response.statusCode == 201){
    final  responseString = response.body;
    TelaDeAnamneseEnfermagem anamneseEnfermagem = (telaDeAnamneseEnfermagemFromJson(responseString));
    Container retorno = Container(
        child: Column(
          children: [
            Container(
              child: Column(
                children: [
                  Container(
                    child: Text("Nome do Paciente:", style: TextStyle(fontSize: 20.0,fontWeight: FontWeight.bold)),
                  ),
                  Container(
                    child: Text(anamneseEnfermagem.nomeUsuario, style: TextStyle(fontSize: 18.0)),
                  ),
                  Container(
                      child: Divider(
                        color: Colors.grey,
                        height: 30,
                        thickness: 1,
                        indent: 20,
                        endIndent: 20,
                      )
                  ),
                  Container(
                    child: Text("Queixa Principal:"),
                  ),
                  Container(
                    child: Text(anamneseEnfermagem.queixaPrincipal),
                  ),
                  Container(
                      child: Divider(
                        color: Colors.grey,
                        height: 30,
                        thickness: 1,
                        indent: 20,
                        endIndent: 20,
                      )
                  ),
                  Container(
                    child: Text("Início:"),
                  ),
                  Container(
                    child: Text(anamneseEnfermagem.inicio),
                  ),
                  Container(
                      child: Divider(
                        color: Colors.grey,
                        height: 30,
                        thickness: 1,
                        indent: 20,
                        endIndent: 20,
                      )
                  ),
                  Container(
                    child: Text("Possui alguma doença?"),
                  ),
                  Container(
                    child: Text(anamneseEnfermagem.doenca),
                  ),
                  Container(
                      child: Divider(
                        color: Colors.grey,
                        height: 30,
                        thickness: 1,
                        indent: 20,
                        endIndent: 20,
                      )
                  ),
                  Container(
                    child: Text("Possui alguma alergia?"),
                  ),
                  Container(
                    child: Text(anamneseEnfermagem.alergia),
                  ),
                  Container(
                    child: Text(anamneseEnfermagem.descAlergia),
                  ),
                  Container(
                      child: Divider(
                        color: Colors.grey,
                        height: 30,
                        thickness: 1,
                        indent: 20,
                        endIndent: 20,
                      )
                  ),
                  Container(
                    child: Text("Usa algum medicamento?"),
                  ),
                  Container(
                    child: Text(anamneseEnfermagem.medicamento),
                  ),
                  Container(
                    child: Text(anamneseEnfermagem.descMedicamento),
                  ),
                  Container(
                      child: Divider(
                        color: Colors.grey,
                        height: 30,
                        thickness: 1,
                        indent: 20,
                        endIndent: 20,
                      )
                  ),
                  Container(
                    child: Text("Fumante?"),
                  ),
                  Container(
                    child: Text(anamneseEnfermagem.fumo),
                  ),

                  Container(
                      child: Divider(
                        color: Colors.grey,
                        height: 30,
                        thickness: 1,
                        indent: 20,
                        endIndent: 20,
                      )
                  ),
                  Container(
                    child: Text("Bebidas alcóolicas?"),
                  ),
                  Container(
                    child: Text(anamneseEnfermagem.bebidas),
                  ),

                  Container(
                      child: Divider(
                        color: Colors.grey,
                        height: 30,
                        thickness: 1,
                        indent: 20,
                        endIndent: 20,
                      )
                  ),
                  Container(
                    child: Text("Usuário de drogas?"),
                  ),
                  Container(
                    child: Text(anamneseEnfermagem.drogas),
                  ),

                  Container(
                      child: Divider(
                        color: Colors.grey,
                        height: 30,
                        thickness: 1,
                        indent: 20,
                        endIndent: 20,
                      )
                  ),
                  Container(
                    child: Text("Pratica Exercícios?"),
                  ),
                  Container(
                    child: Text(anamneseEnfermagem.exercicios),
                  ),

                  Container(
                      child: Divider(
                        color: Colors.grey,
                        height: 30,
                        thickness: 1,
                        indent: 20,
                        endIndent: 20,
                      )
                  ),
                  Container(
                    child: Text("Pratica Exercícios?"),
                  ),
                  Container(
                    child: Text(anamneseEnfermagem.exercicios),
                  ),

                  Container(
                      child: Divider(
                        color: Colors.grey,
                        height: 30,
                        thickness: 1,
                        indent: 20,
                        endIndent: 20,
                      )
                  ),
                  Container(
                    child: Text("Pratica atividades de recreação ou lazer?"),
                  ),
                  Container(
                    child: Text(anamneseEnfermagem.recreacao),
                  ),

                  Container(
                      child: Divider(
                        color: Colors.grey,
                        height: 30,
                        thickness: 1,
                        indent: 20,
                        endIndent: 20,
                      )
                  ),
                  Container(
                    child: Text("Possui animais domésticos?"),
                  ),
                  Container(
                    child: Text(anamneseEnfermagem.animais),
                  ),

                  Container(
                      child: Divider(
                        color: Colors.grey,
                        height: 30,
                        thickness: 1,
                        indent: 20,
                        endIndent: 20,
                      )
                  ),
                  Container(
                    child: Text("Possui animais domésticos?"),
                  ),
                  Container(
                    child: Text(anamneseEnfermagem.animais),
                  ),
                  Container(
                      child: Divider(
                        color: Colors.grey,
                        height: 30,
                        thickness: 1,
                        indent: 20,
                        endIndent: 20,
                      )
                  ),
                  Container(
                    child: Text("Tem acesso à postos de saúde?"),
                  ),
                  Container(
                    child: Text(anamneseEnfermagem.postos),
                  ),
                  Container(
                      child: Divider(
                        color: Colors.grey,
                        height: 30,
                        thickness: 1,
                        indent: 20,
                        endIndent: 20,
                      )
                  ),
                  Container(
                    child: Text("Há alguma doença relacionada na familia:"),
                  ),
                  Container(
                    child: Text(anamneseEnfermagem.doencaFamilia),
                  ),
                  Container(
                    child: Text("Tratamento: "+anamneseEnfermagem.tratamentoFamilia),
                  ),
                  Container(
                      child: Divider(
                        color: Colors.grey,
                        height: 30,
                        thickness: 1,
                        indent: 20,
                        endIndent: 20,
                      )
                  ),
                ],
              ),
            ),

          ],
        )
    );
    return retorno;
  }else{
    return null;
  }
}
class _telaAnamneseEnfermagemState extends State<TelaAnamneseEnfermagem> {
  Widget build(BuildContext context) {
    final String idUsuario = ModalRoute.of(context).settings.arguments;
    TelaAnamneseEnfermagem _dados_anamnese;
    return Scaffold(
        backgroundColor: Colors.white,
        body: SingleChildScrollView(
            child: Column(
                children: <Widget>[
                  Container(
                    height: 150,
                    decoration: BoxDecoration(
                        image: DecorationImage(
                            image: AssetImage('assets/images/header.png'),
                            fit: BoxFit.none
                        )
                    ),
                  ),
                  Container(
                      child: Text("FICHA DE PRÉ AVALIAÇÃO", style: TextStyle(fontSize: 25.0))
                  ),
                  Container(
                      child: Divider(
                        color: Colors.black,
                        height: 30,
                        thickness: 2,
                        indent: 20,
                        endIndent: 20,
                      )
                  ),
                  Container(
                    child: RaisedButton(
                        child: Text("Voltar"),
                        onPressed: () {
                          Navigator.pop(context,true);
                        }
                    ),
                  ),
                  Container(
                      child: Divider(
                        color: Colors.grey,
                        height: 30,
                        thickness: 1,
                        indent: 20,
                        endIndent: 20,
                      )
                  ),
                  FutureBuilder <Container>(
                    future: gerarAnamneseEnfermagem(idUsuario),
                    builder: (BuildContext context, AsyncSnapshot<Container> text){
                      if(text.hasData){
                        return text.data;
                      }else{
                        return Text("Não foram encontrados dados");
                      }
                    },
                  ),

                  Container(
                    child: RaisedButton(
                        child: Text("Voltar"),
                        onPressed: () {
                          Navigator.pop(context,true);
                        }
                    ),
                  ),
                  Container(
                    child: Text(""),
                  )
                ]
            )
        )
    );
  }
}
/*-------------------------------------------------------------------*/
/*----------------- FUNÇÕES TELA ANAMNESE ENFERMAGEM ----------------*/
Future<Container> gerarAnamneseFisio(String idUsuario) async {
  String apiUrl = "http://192.168.56.1/clinicaTcc/post.php";
  final response = await http.post(apiUrl, body:{
    "acao": "ver_anamnese_fisio",
    "idUsuario": idUsuario,
  });
  if(response.statusCode == 201){
    final  responseString = response.body;
    TelaDeAnamneseFisio anamneseFisio = (telaDeAnamneseFisioFromJson(responseString));
    print(anamneseFisio);
    Container retorno = Container(
        child: Column(
          children: [
            Container(
              child: Column(
                children: [
                  Container(
                    child: Text("Nome do Paciente:", style: TextStyle(fontSize: 20.0,fontWeight: FontWeight.bold)),
                  ),
                  Container(
                    child: Text(anamneseFisio.nomeUsuario, style: TextStyle(fontSize: 18.0)),
                  ),
                  Container(
                      child: Divider(
                        color: Colors.grey,
                        height: 30,
                        thickness: 1,
                        indent: 20,
                        endIndent: 20,
                      )
                  ),
                  Container(
                    child: Text("Queixa Principal:"),
                  ),
                  Container(
                    child: Text(anamneseFisio.queixaPrincipal),
                  ),
                  Container(
                      child: Divider(
                        color: Colors.grey,
                        height: 30,
                        thickness: 1,
                        indent: 20,
                        endIndent: 20,
                      )
                  ),
                  Container(
                    child: Text("Início:"),
                  ),
                  Container(
                    child: Text(anamneseFisio.inicio),
                  ),
                  Container(
                      child: Divider(
                        color: Colors.grey,
                        height: 30,
                        thickness: 1,
                        indent: 20,
                        endIndent: 20,
                      )
                  ),
                  Container(
                    child: Text("Possui alguma doença?"),
                  ),
                  Container(
                    child: Text(anamneseFisio.doenca),
                  ),
                  Container(
                      child: Divider(
                        color: Colors.grey,
                        height: 30,
                        thickness: 1,
                        indent: 20,
                        endIndent: 20,
                      )
                  ),
                  Container(
                    child: Text("Possui alguma alergia?"),
                  ),
                  Container(
                    child: Text(anamneseFisio.alergia),
                  ),
                  Container(
                    child: Text(anamneseFisio.descAlergia),
                  ),
                  Container(
                      child: Divider(
                        color: Colors.grey,
                        height: 30,
                        thickness: 1,
                        indent: 20,
                        endIndent: 20,
                      )
                  ),
                  Container(
                    child: Text("Usa algum medicamento?"),
                  ),
                  Container(
                    child: Text(anamneseFisio.medicamento),
                  ),
                  Container(
                    child: Text(anamneseFisio.descMedicamento),
                  ),
                  Container(
                      child: Divider(
                        color: Colors.grey,
                        height: 30,
                        thickness: 1,
                        indent: 20,
                        endIndent: 20,
                      )
                  ),
                  Container(
                    child: Text("Fumante?"),
                  ),
                  Container(
                    child: Text(anamneseFisio.fumo),
                  ),

                  Container(
                      child: Divider(
                        color: Colors.grey,
                        height: 30,
                        thickness: 1,
                        indent: 20,
                        endIndent: 20,
                      )
                  ),
                  Container(
                    child: Text("Bebidas alcóolicas?"),
                  ),
                  Container(
                    child: Text(anamneseFisio.bebidas),
                  ),

                  Container(
                      child: Divider(
                        color: Colors.grey,
                        height: 30,
                        thickness: 1,
                        indent: 20,
                        endIndent: 20,
                      )
                  ),
                  Container(
                    child: Text("Usuário de drogas?"),
                  ),
                  Container(
                    child: Text(anamneseFisio.drogas),
                  ),

                  Container(
                      child: Divider(
                        color: Colors.grey,
                        height: 30,
                        thickness: 1,
                        indent: 20,
                        endIndent: 20,
                      )
                  ),
                  Container(
                    child: Text("Pratica Exercícios?"),
                  ),
                  Container(
                    child: Text(anamneseFisio.exercicios),
                  ),

                  Container(
                      child: Divider(
                        color: Colors.grey,
                        height: 30,
                        thickness: 1,
                        indent: 20,
                        endIndent: 20,
                      )
                  ),
                  Container(
                    child: Text("Pratica Exercícios?"),
                  ),
                  Container(
                    child: Text(anamneseFisio.exercicios),
                  ),

                  Container(
                      child: Divider(
                        color: Colors.grey,
                        height: 30,
                        thickness: 1,
                        indent: 20,
                        endIndent: 20,
                      )
                  ),
                  Container(
                    child: Text("Pratica atividades de recreação ou lazer?"),
                  ),
                  Container(
                    child: Text(anamneseFisio.recreacao),
                  ),

                  Container(
                      child: Divider(
                        color: Colors.grey,
                        height: 30,
                        thickness: 1,
                        indent: 20,
                        endIndent: 20,
                      )
                  ),



                  Container(
                    child: Text("Possui animais domésticos?"),
                  ),
                  Container(
                    child: Text(anamneseFisio.animais),
                  ),

                  Container(
                      child: Divider(
                        color: Colors.grey,
                        height: 30,
                        thickness: 1,
                        indent: 20,
                        endIndent: 20,
                      )
                  ),
                  Container(
                    child: Text("Tem acesso à postos de saúde?"),
                  ),
                  Container(
                    child: Text(anamneseFisio.postos),
                  ),
                  Container(
                      child: Divider(
                        color: Colors.grey,
                        height: 30,
                        thickness: 1,
                        indent: 20,
                        endIndent: 20,
                      )
                  ),
                  Container(
                    child: Text("Há alguma doença relacionada na familia:"),
                  ),
                  Container(
                    child: Text(anamneseFisio.doencaFamilia),
                  ),
                  Container(
                    child: Text("Tratamento: "+anamneseFisio.tratamentoFamilia),
                  ),
                  Container(
                      child: Divider(
                        color: Colors.grey,
                        height: 30,
                        thickness: 1,
                        indent: 20,
                        endIndent: 20,
                      )
                  ),
                ],
              ),
            ),

          ],
        )
    );
    print(response.body);
    return retorno;
  }else{
    return null;
  }
}
class _telaAnamneseFisioState extends State<TelaAnamneseFisio> {
  Widget build(BuildContext context) {
    final String idUsuario = ModalRoute.of(context).settings.arguments;
    TelaAnamneseFisio _dados_anamnese;
    print(idUsuario);
    return Scaffold(
        backgroundColor: Colors.white,
        body: SingleChildScrollView(
            child: Column(
                children: <Widget>[
                  Container(
                    height: 150,
                    decoration: BoxDecoration(
                        image: DecorationImage(
                            image: AssetImage('assets/images/header.png'),
                            fit: BoxFit.none
                        )
                    ),
                  ),
                  Container(
                      child: Text("FICHA DE PRÉ AVALIAÇÃO", style: TextStyle(fontSize: 25.0))
                  ),
                  Container(
                      child: Divider(
                        color: Colors.black,
                        height: 30,
                        thickness: 2,
                        indent: 20,
                        endIndent: 20,
                      )
                  ),
                  Container(
                    child: RaisedButton(
                        child: Text("Voltar"),
                        onPressed: () {
                          Navigator.pop(context,true);
                        }
                    ),
                  ),
                  Container(
                      child: Divider(
                        color: Colors.grey,
                        height: 30,
                        thickness: 1,
                        indent: 20,
                        endIndent: 20,
                      )
                  ),
                  FutureBuilder <Container>(
                    future: gerarAnamneseFisio(idUsuario),
                    builder: (BuildContext context, AsyncSnapshot<Container> text){
                      if(text.hasData){
                        return text.data;
                      }else{
                        print(text.data);
                        return Text("Não foram encontrados dados");
                      }
                    },
                  ),

                  Container(
                    child: RaisedButton(
                        child: Text("Voltar"),
                        onPressed: () {
                          Navigator.pop(context,true);
                        }
                    ),
                  ),
                  Container(
                    child: Text(""),
                  )
                ]
            )
        )
    );
  }
}
/*-------------------------------------------------------------------*/


