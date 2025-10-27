<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Stichoza\GoogleTranslate\GoogleTranslate;

class AutoTranslateViews extends Command
{
    protected $signature = 'views:auto-translate';
    protected $description = 'Auto translate hardcoded English texts in Blade views to Indonesian and replace with __()';

    public function handle()
    {
        $translator = new GoogleTranslate('id');
        $basePath = resource_path('views');
        $langPath = lang_path('id/messages.php');

        $translations = file_exists($langPath) ? include $langPath : [];

        $this->info("Scanning Blade files in: {$basePath}");

        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($basePath));
        foreach ($iterator as $file) {
            if (!$file->isFile() || $file->getExtension() !== 'php') continue;

            $path = $file->getPathname();
            $content = file_get_contents($path);

            // Regex untuk menangkap teks biasa diantara tag HTML (bukan Blade syntax)
            preg_match_all('/>([^<>\{\}@]+)</', $content, $matches);

            foreach ($matches[1] as $rawText) {
                $text = trim($rawText);
                if ($text === '' || strlen($text) < 2) continue;
                if (preg_match('/[{}@]/', $text)) continue; // skip blade directive

                // Kalau sudah pernah diterjemahkan, skip
                if (!isset($translations[$text])) {
                    try {
                        $translated = $translator->translate($text);
                        $translations[$text] = $translated;
                        $this->info("Translated: \"$text\" -> \"$translated\"");
                    } catch (\Exception $e) {
                        $this->error("Error translating '$text': " . $e->getMessage());
                    }
                }

                // Ganti teks di file dengan {{ __('text') }}
                $escaped = preg_quote($text, '/');
                $content = preg_replace(
                    "/>{$escaped}</",
                    ">{{ __('$text') }}<",
                    $content
                );
            }

            file_put_contents($path, $content);
        }

        // Simpan hasil translate
        file_put_contents($langPath, "<?php\n\nreturn " . var_export($translations, true) . ";\n");
        $this->info("\n✅ Done! Translations saved to: lang/id/messages.php");
    }
}
