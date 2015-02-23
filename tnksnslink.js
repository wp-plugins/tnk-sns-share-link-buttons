function tnksns_ctag(t, n){
	if(!n) n = "title";
	return (t) ? "&"+n+"="+t : "";
}

function tnksns(id, sv){
	var plink = encodeURIComponent(document.getElementById("tnksns_"+id+"_l").textContent);
	var title = encodeURIComponent(document.getElementById("tnksns_"+id+"_t").textContent);
	
	var url = null;
	if(sv == "tw"){
		url = "http://twitter.com/share?url="+plink+tnksns_ctag(title, "text");
	}else if(sv == "fb"){
		url = "http://www.facebook.com/sharer/sharer.php?u="+plink;
	}else if(sv == "gp"){
		url = "https://plus.google.com/share?url="+plink;
	}else if(sv == "tb"){
		url = "http://www.tumblr.com/share?v=3&u="+plink+tnksns_ctag(title, "t");
	}else if(sv == "dg"){
		url = "http://digg.com/submit?url="+plink+tnksns_ctag(title);
	}else if(sv == "pi"){
		url = "https://pinboard.in/popup_login/?url="+plink+tnksns_ctag(title);
	}else if(sv == "pk"){
		url = "http://getpocket.com/edit?url="+plink+tnksns_ctag(title);
	}else if(sv == "rd"){
		url = "http://www.reddit.com/submit?url="+plink+tnksns_ctag(title);
	}else if(sv == "en"){
		url = "http://www.evernote.com/clip.action?url="+plink+tnksns_ctag(title);
	}else if(sv == "wp"){
		url = "http://wordpress.com/press-this.php?u="+plink+tnksns_ctag(title, "t");
	}else if(sv == "li"){
		url = "http://www.linkedin.com/shareArticle?mini=true&url="+plink+tnksns_ctag(title);
	}else if(sv == "mx"){
		url = "http://mixi.jp/share.pl?u="+plink+"&k="+tnksns_mk;
	}else if(sv == "hb"){
		url = "http://b.hatena.ne.jp/add?url="+plink+tnksns_ctag(title);
	}else if(sv == "dl"){
		url = "http://www.delicious.com/save?url="+plink+tnksns_ctag(title);
	}else if(sv == "gb"){
		url = "http://www.google.com/bookmarks/mark?op=edit&bkmk="+plink+tnksns_ctag(title);
	}else if(sv == "yb"){
		url = "http://bookmarks.yahoo.co.jp/bookmarklet/showpopup?u="+plink+tnksns_ctag(title, "t");
	}else if(sv == "ln"){
		url = "http://line.me/R/msg/text/?"+plink;
	}else if(sv == "ml"){
		location.href = "mailto:?body="+plink+tnksns_ctag(title, "subject");
	}
	if(url) window.open(url);
}