
<head>
  <title>E-commerce</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!--estilizando a página com framework Bootstrap-->
  <link
    rel="stylesheet"
    type="text/css"
    href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900"
  >
  <!--estilizando a página com framework Bootstrap-->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
  >
  <style>
    html, body {      
      min-width: 100%;
		  min-height: 100%;
    }

    * {
      --md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
      --lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
      --xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);

      --grey1: #f7fafc;
      --grey2: #edf2f7;
      --grey3: #e2e8f0;
      --grey4: #cbd5e0;
      --grey5: #a0aec0;
      --grey6: #718096;
      --grey7: #4a5568;
      --grey8: #2d3748;
      --grey9: #1a202c;

      --blue1: #ebf8ff;
      --blue4: #63b3ed;
      --blue5: #4299e1;
      --blue6: #3182ce;

      --green1: #f0fff4;
      --green4: #68d391;
      --green5: #48bb78;
      --green6: #38a169;
      
      --yellow1: #fffff0;
      --yellow4: #f6e05e;
      --yellow5: #ecc94b;
      --yellow6: #d69e2e;

      --red1: #fff5f5;
      --red4: #fc8181;
      --red5: #f56565;
      --red6: #e53e3e;

      margin: 0;
      padding: 0;
      font-family: "Poppins";
    }

    /* Others */
    
    .py {
      padding: 5rem 0;
    }    

    /* Rows & Cols */

    .row {
      display: grid;
      grid-template-columns: 1fr;
      grid-column-gap: 1rem;
    }

      @media (min-width: 768px) {
        .row[columns="2"] {
          grid-template-columns: 1fr 1fr;
        }
        .row[columns="3"] {
          grid-template-columns: 1fr 1fr 1fr;
        }
        .row[columns="4"] {
          grid-template-columns: 1fr 1fr 1fr 1fr;
        }
      }

    .col {
      grid-column: span 1;
    }

    @media (min-width: 768px) {
      .col[span="2"] {
        grid-column: span 2;
      }
      .col[span="3"] {
        grid-column: span 3;
      }
      .col[span="4"] {
        grid-column: span 4;
      }
    }      

    .container {
      display: grid;
      grid-template-columns: 1fr repeat(12, minmax(auto, 60px)) 1fr;
      grid-column-gap: 20px;
    }

      @media (min-width: 640px) {
        .container {
          grid-column-gap: 40px;
        }
      }

    .input {
      width: 100%;
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      margin-bottom: .5rem;
    }

      .input label {
        width: 100%;
        font-size: .75rem;
        text-transform: uppercase;
      }

      .input input {
        width: 100%;  
        box-sizing: border-box;
        font-size: .875rem;
        padding: .5rem .75rem;
        outline: none;
        user-select: auto;
        color: var(--grey8);
      }

      .input small {
        width: 100%;
        margin-top: .25rem;
        display: block;
        line-height: 1;
        font-size: .75rem;
      }

      .input[color="primary"] label {
        color: var(--grey5);
      }
      .input[color="danger"] label {
        color: var(--red5);
      }
      
      .input[color="primary"] input {
        border: 1px solid var(--grey5);
      }
      .input[color="danger"] input {
        border: 1px solid var(--red5);
      }
      
      .input[color="primary"] small {
        color: var(--grey5);
      }
      .input[color="danger"] small {
        color: var(--red5);
      }

    .file-input {
      margin-bottom: .5rem;
      width: 100%;
      user-select: none;
      pointer-events: none;
    }

      .file-input label:first-of-type {
        font-size: .75rem;
        text-transform: uppercase;
      }

      .file-input label:last-of-type {
        display: flex;
        position: relative;
      }

        .file-input input:first-of-type {
          position: absolute;
          opacity: 0;
          top:0;
          left: 0;
          bottom: 0;
          right: 0;
        }

        .file-input input:last-of-type {
          outline: none;
          border: none;
          width: 100%;		
          text-transform: none;			
          padding: .5rem .75rem;
          font-size: .875rem;
          user-select: auto;
          color: var(--grey8);
          background: white;
          cursor: default;
          display: flex;
          align-items: center;
        }

          .file-input input:last-of-type::placeholder {
            color: var(--grey5);
          }

        .file-input div {
          padding: .25rem .75rem;
          outline: none;
          font-size: 1rem;
          color: white;
          cursor: pointer;
          background: var(--grey5);
          pointer-events: auto;
        }

      .file-input small {
        margin-top: .25rem;
        display: block;
        line-height: 1;
        font-size: .75rem;
      }

      .file-input[color="primary"] label:first-of-type {
        color: var(--grey5);
      }
      .file-input[color="danger"] label:first-of-type {
        color: var(--red5);
      }
      
      .file-input[color="primary"] label:last-of-type {
        border: 1px solid var(--grey5);
      }
      .file-input[color="danger"] label:last-of-type {
        border: 1px solid var(--red5);
      }
      
      .file-input[color="primary"] div {
        background: var(--grey5);
      }
      .file-input[color="danger"] div {
        background: var(--red5);
      }
      
        .file-input[color="primary"] div:hover {
          background: var(--grey6);
        }
        .file-input[color="danger"] div:hover {
          background: var(--red6);
        }
			
      .file-input[color="primary"] small {
        color: var(--grey5);
      }
      .file-input[color="danger"] small {
        color: var(--red5);
      }

    .title {
      font-weight: 600;
      font-size: 1.5rem;
      text-transform: uppercase;
      color: var(--grey8);
      position: relative;
      margin-bottom: 1.5rem;
      text-align: center;
    }

      .title::after {
        content: "";
        width: 72px;
        height: 5px;
        position: absolute;
        bottom: -5px;
      }

      .title span {
        position: absolute;
        color: var(--grey5);
        text-transform: uppercase;
        font-size: .675rem;
        margin-left: .25rem;
      }

      .title[color="primary"]::after {
        background: var(--blue4);
      }
      .title[color="success"]::after {
        background: var(--green4);
      }
      .title[color="warning"]::after {
        background: var(--yellow4);
      }
      .title[color="danger"]::after {
        background: var(--red4);
      }

    .title[align="left"] {
      text-align: left;
    }
    .title[align="center"] {
      text-align: center;
    }
    .title[align="right"] {
      text-align: right;
    }

      .title[align="left"]::after {
        left: 00%;
        transform: translateX(00%);
      }
      .title[align="center"]::after {
        left: 50%;
        transform: translateX(-50%);
      }
      .title[align="right"]::after {
        left: 100%;
        transform: translateX(-100%);
      }

    .button {
      text-decoration: none;
      white-space: nowrap;
      text-align: center;
      text-transform: uppercase;
      font-size: .875rem;
      font-weight: 500;
      padding: .5rem .75rem;
      cursor: pointer;
      color: white;
      outline: none;
      border: none;
    }

    .button[color="primary"] {
      background: var(--blue4);
    }
    .button[color="secondary"] {
      background: var(--grey5);
    }
    .button[color="success"] {
      background: var(--green4);
    }
    .button[color="warning"] {
      background: var(--yellow4);
    }
    .button[color="danger"] {
      background: var(--red4);
    }

      .button[color="primary"]:hover {
        background: var(--blue5);
        color: var(--blue1);
      }
      .button[color="secondary"]:hover {
        background: var(--grey6);
        color: var(--grey1);
      }
      .button[color="success"]:hover {
        background: var(--green5);
        color: var(--green1);
      }
      .button[color="warning"]:hover {
        background: var(--yellow5);
        color: var(--yellow1);
      }
      .button[color="danger"]:hover {
        background: var(--red5);
        color: var(--red1);
      }

    .button[size="full"] {
      width: 100%;
    }
    .button[size="auto"] {
      width: auto;
    }
    
    .button[icon="margin-right"] i {
      margin-right: .5rem;
    }
    .button[icon="margin-left"] i {
      margin-left: .5rem;
    }
    .button[icon="no-margin"] i {
      margin: 0;
    }

    .message {
      font-size: .875rem;
      margin-bottom: .5rem;
    }

      .message span {
        color: var(--blue4);
      }

    .message[color="primary"] {      
      color: var(--grey8);
    }
    .message[color="secondary"] {      
      color: var(--grey5);
    }
    .message[color="danger"] {      
      color: var(--red5);
    }
    
    .message[text-align="left"] {      
      text-align: left;
    }
    .message[text-align="center"] {    
      text-align: center;
    }
    .message[text-align="right"] {    
      text-align: right;
    }

    .message[size="sm"] {      
      font-size: .75rem;
    }
    .message[size="md"] {      
      font-size: .875rem;
    }
    .message[size="lg"] {      
      font-size: 1rem;
    }


    .form {
      padding: 1rem .75rem;
      display: flex;
      flex-direction: column;
      box-shadow: var(--lg);
    }

    .form[size="sm"],
    .form[size="md"],
    .form[size="lg"],
    .form[size="xl"] {
      grid-column: 2 / span 12;
    }

      @media (min-width: 640px) {
        .form[size="sm"] {
          grid-column: 4 / span 8;
        }
      }
      
      @media (min-width: 768px) {
        .form[size="sm"] {
          grid-column: 5 / span 6;
        }
        .form[size="md"] {
          grid-column: 4 / span 8;
        }
      }
      
      @media (min-width: 1024px) {
        .form[size="sm"] {
          grid-column: 6 / span 4;
        }
        .form[size="md"] {
          grid-column: 5 / span 6;
        }
        .form[size="lg"] {
          grid-column: 4 / span 8;
        }
      }

    .collapsible-table {
      grid-column: 2 / span 12;      
      overflow: hidden;
    }

      .collapsible-table .table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 2px solid white;
      }

        .collapsible-table h3 {
          width: 100%;
          background: var(--blue4);
          padding: .5rem 0 .5rem 1rem;
          color: white;
          font-size: .875rem;
          font-weight: 600;
          text-transform: uppercase;
        }

        .collapsible-table a::after {
          margin-left: .5rem;
        }

        .collapsible-table a[text="adicionar"]:hover::after {
          content: "adicionar";
        } 
        .collapsible-table a[text="editar"]:hover::after {
          content: "editar";
        } 
        .collapsible-table a[text="excluir"]:hover::after {
          content: "excluir";
        } 

      .collapsible-table .table-wrapper {
      	margin-bottom: 1.5rem;
        overflow: auto;
        display: none;
      }

        .collapsible-table ::-webkit-scrollbar {
          width: 5px;
          height: 5px;
        }

        .collapsible-table ::-webkit-scrollbar-track {
          background: var(--grey2);
        }

        .collapsible-table ::-webkit-scrollbar-thumb {
          background: var(--grey4);
        }
    
          .collapsible-table ::-webkit-scrollbar-thumb:hover {
            background: var(--grey5);
          }

        .collapsible-table table {
          width: 100%;
          min-width: 927px;
        }

          .collapsible-table tbody th:last-child {
            white-space: nowrap;
          }

          .collapsible-table thead {
            background: var(--blue4);
          }

            .collapsible-table thead th {
              font-weight: 600;
              color: white;
              padding: .5rem;
              font-size: .875rem;
            }

          .collapsible-table tbody tr:nth-child(even) {
            background: var(--blue1);
          }
          .collapsible-table tbody tr:nth-child(odd) {
            background: var(--grey1);
          }

          .collapsible-table tbody th:last-child i {
            padding: .5rem .75rem;
            cursor: pointer;    
          }

          .collapsible-table tbody th:last-child i.fa-edit {
            color: var(--yellow4);            
          }
            .collapsible-table tbody th:last-child i.fa-edit:hover {
              color: var(--yellow5);            
            }
          .collapsible-table tbody th:last-child i.fa-trash,
          .collapsible-table tbody th:last-child i.fa-times {
            color: var(--red4);            
          }
            .collapsible-table tbody th:last-child i.fa-trash:hover,
            .collapsible-table tbody th:last-child i.fa-times:hover {
              color: var(--red5);            
            }

            .collapsible-table tbody th {
              color: var(--grey5);
              font-weight: 400;
              font-size: .875rem;
            }

      .collapsible-table .show {
        display: block;
      }


    /* Estilizando o rodapé */

    .footer {
      background: var(--grey1);
      padding: 1rem;
    }

      .footer p {
        text-align: center;
        color: var(--grey5);
        font-size: .875rem;
      }


  </style>
</head>