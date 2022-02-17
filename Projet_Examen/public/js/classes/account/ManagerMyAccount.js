export default class ManagerMyAccount {
	formUpInfo() {
		// je recupere les valeurs du formulaire
		let id = document.querySelector("#numUser1").value;
		let lastName = document.querySelector("#lastName").value;

		// console.log(id,firstName,lastName,adress)
		// utilisation du formData et de fetch
		let formData = new FormData();
		formData.append("action", "upInfo");
		formData.append("id", id);
		formData.append("lastName", lastName);

		this.sendAjax("index.php?ajax=upInfo", formData, ".return1");
	}

	formUpPass() {
		// je recupere les valeurs du formulaire
		let id = document.querySelector("#numUser2").value;
		let password1 = document.querySelector("#password1").value;
		let password2 = document.querySelector("#password2").value;
		let password3 = document.querySelector("#password3").value;

		// utilisation du formData et de fetch
		let formData = new FormData();
		formData.append("action", "upPass");
		formData.append("id", id);
		formData.append("password1", password1);
		formData.append("password2", password2);
		formData.append("password3", password3);

		this.sendAjax("index.php?ajax=upPass", formData, ".return2");
	}

	sendAjax(url, formdata, divResponse) {
		fetch(url, { method: "POST", body: formdata })
			.then((res) => res.text())
			.then(function (mes) {
				document.querySelector(divResponse).innerHTML = mes;
			});
	}
}
