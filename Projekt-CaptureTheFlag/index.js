//Das Skript sorgt dafür, dass ein Text Buchstabe für Buchstabe ausgegeben wird.

var reveal = function (target, message, index, interval) {   
  if (index < message.length) {
    $(target).append(message[index++]);
    setTimeout(function () { reveal(target, message, index, interval); }, interval);
  }
}