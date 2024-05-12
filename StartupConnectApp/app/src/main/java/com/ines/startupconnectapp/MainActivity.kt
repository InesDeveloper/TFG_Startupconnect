package com.ines.startupconnectapp

import android.os.Bundle
import android.webkit.WebView
import android.webkit.WebViewClient
import android.webkit.WebResourceRequest
import androidx.activity.enableEdgeToEdge
import androidx.appcompat.app.AppCompatActivity
import androidx.core.view.ViewCompat
import androidx.core.view.WindowInsetsCompat

class MainActivity : AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)
        val url = "http://10.0.2.2:8888/startupconnect/"
        val miVistaWeb: WebView = findViewById(R.id.vistaWeb)
        miVistaWeb.loadUrl(url)
        val ajustesVisorWeb = miVistaWeb.getSettings()
        ajustesVisorWeb.javaScriptEnabled = true

        miVistaWeb.webViewClient = object : WebViewClient() {
            override fun shouldOverrideUrlLoading(view: WebView?, request: WebResourceRequest?): Boolean {
                val url: String = request?.url.toString()
                view?.loadUrl(url)
                return true // Siempre maneja la carga de la URL dentro de la WebView
            }
        }
    }
}