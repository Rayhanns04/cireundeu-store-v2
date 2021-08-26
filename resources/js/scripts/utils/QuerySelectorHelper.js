const $ = {
  all(query, elmnt=document) {
    return elmnt.querySelectorAll(query);
  },


  first(query, elmnt=document) {
    return elmnt.querySelector(query);
  },
};

export default $;