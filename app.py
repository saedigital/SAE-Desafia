# -*- coding: utf-8 -*-

from flask import (
    Flask,
    render_template,
    url_for,
    request,
    redirect,
    jsonify,
    Response
)
from flask_pymongo import PyMongo
from bson import ObjectId


app = Flask(__name__)

app.config['MONGO_DBNAME'] = 'saedigital'
app.config['MONGO_URI'] = \
    'mongodb://user_sae:key_sae@ds063833.mlab.com:63833/saedigital'

mongo = PyMongo(app)

@app.route('/')
def index():
    ls_espetaculo = mongo.db.espetaculos.find()
    return render_template('index.html',
                           ls_espetaculo=ls_espetaculo)


@app.route('/espetaculos')
def espetaculos():
    ls_espetaculo = mongo.db.espetaculos.find()
    return render_template('espetaculos.html',
                           ls_espetaculo=ls_espetaculo)


@app.route('/faz_reserva', methods=['POST', 'GET'])
def faz_reserva():
     res_espetaculo     =   request.form['res_espetaculo']
     res_nome_comprador =   request.form['res_nome_comprador']
     res_qtd_assentos   =   int(request.form['res_qtd_assentos'])
     res_pos_assentos   =   request.form['res_pos_assentos']

     mongo.db.reservas.insert_one({
                           "res_espetaculo": res_espetaculo,
                           "res_nome_comprador": res_nome_comprador,
                           "res_qtd_assentos": res_qtd_assentos,
                           "res_pos_assentos": [res_pos_assentos]
                   })

     return redirect(url_for('reservas'))


@app.route('/reservas', methods=['POST', 'GET'])
def reservas():
    ls_espetaculo = mongo.db.espetaculos.find()
    return render_template('reservas.html',
                            ls_espetaculo=ls_espetaculo)


@app.route('/cadastrar', methods=['POST', 'GET'])
def cadastrar():
    cad_espetaculo = request.form.to_dict()
    mongo.db.espetaculos.insert_one(cad_espetaculo)
    return redirect(url_for('espetaculos'))


@app.route('/info_reserva', methods=['POST', 'GET'])
def info_reserva():
    exibir_esp              = (request.args.get('nome_espetaculo'))
    info_reserva            = mongo.db.reservas.find({'res_espetaculo' : exibir_esp})

    return render_template('info_reserva.html',
                            info_reserva=info_reserva)


@app.route('/excluir_esp', methods=['GET'])
def excluir_esp():
    excluir_esp = (request.args.get('nome_espetaculo'))
    mongo.db.espetaculos.remove({'nome_espetaculo': excluir_esp})
    mongo.db.reservas.remove({'res_espetaculo': excluir_esp})
    return redirect(url_for('espetaculos'))


@app.route('/excluir_res', methods=['GET'])
def excluir_res():
    excluir_res = (request.args.get('_id'))
    mongo.db.reservas.remove({'_id': ObjectId(excluir_res)})
    return redirect(url_for('financeiro'))


@app.route('/editar_espetaculo', methods=['GET'])
def editar_espetaculo():
    editar_esp = (request.args.get('_id'))
    edita = mongo.db.espetaculos.find({"_id": ObjectId(editar_esp)})
    return render_template('editar_espetaculos.html',
                            edita=edita)


@app.route('/atualiza_esp', methods=['POST', 'GET'])
def atualiza_esp():

    meu_id = request.form['_id']
    nova_inf = request.form['informacoes2']

    mongo.db.espetaculos.update_one(
        {"_id": ObjectId(meu_id)},
        {
        "$set": {
            "informacoes" : nova_inf
        }
        }
    )

    return redirect(url_for('espetaculos'))


@app.route('/financeiro', methods=['POST', 'GET'])
def financeiro():
    ls_espetaculo = mongo.db.espetaculos.find()
    return render_template('financeiro.html',
                            ls_espetaculo=ls_espetaculo)


if __name__ == '__main__':
    app.secret_key = 'mysecret'
    app.run(host='0.0.0.0', port=5000, debug=True)
