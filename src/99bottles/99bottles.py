from flask import Flask

app = Flask(__name__)

@app.route("/")
def hello():
    html = ''
    for x in range(5,-1,-1):
      if x == 1:
       html += str(x) + 'bottles of beer on the wall, '+str(x)+'bottles of beer.<br/>'
       html += 'Take one down and pass it around, no more bottles of beer on the wall.<br/>'
      if x == 0:
        html += 'No more bottles of beer on the wall, no more bottles of beer.<br/>'
        html += 'Go to the store and buy some more, 99 bottles of beer on the wall.<br/>'
      else:
       html += str(x) + 'bottles of beer on the wall, '+str(x)+'bottles of beer.<br/>'
       html += 'Take one down and pass it around, '+str(x-1)+' bottles of beer on the wall.<br/>'

    return html

if __name__ == "__main__":
    app.run(host='0.0.0.0', port=80)

